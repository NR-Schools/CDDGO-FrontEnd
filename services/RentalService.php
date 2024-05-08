<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/RentalModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/RentalRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/ReservationRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/BoardGameRepository.php";


class RentalService
{
    static function addUserRentsGame(Rental $rental): array
    {
        // Check if student has an existing rental record
        // Check if game is available
        // Check for reservations by other users
        $attemptStatus = RentalRepository::isRentalAttemptValid(
            $rental->student->StudID,
            $rental->boardGame->GameID
        );

        if ($attemptStatus !== "AVAILABLE")
            return [false, $attemptStatus];

        // Get All Reservations
        $reservations = ReservationRepository::getAllReservationsByStudent($rental->student->StudID);
        foreach ($reservations as $reservation) {
            assert($reservation instanceof Reservation);

            // Consume reservation if Reservation Date is the same with current day
            if (
                $rental->boardGame->GameID === $reservation->boardGame->GameID &&
                date("Y-m-d") === $reservation->ReservedDate
            ) {
                ReservationRepository::deleteReservation($reservation->ReservationID);
                break;
            }

        }

        // Add Rental by User
        RentalRepository::addNewRental($rental);
        return [true, "SUCCESS"];
    }

    static function getAllConfirmedRentals(): array
    {
        // Get all rentals (confirmed)
        return RentalRepository::getAllRentals(true);
    }

    static function getAllUnconfirmedRentals(): array
    {
        // Get all rentals (unconfirmed)
        return RentalRepository::getAllRentals(false);
    }

    static function adminConfirmRental(int $rentalId): bool
    {
        $rental = RentalRepository::getRentalById($rentalId);

        // Update Rental, make it confirmed
        $rental->RentConfirm = true;
        RentalRepository::confirmRental($rental);

        // Check if space for new rentals exists
        $isGameOpen = RentalRepository::checkGameAvailability($rental->boardGame->GameID);
        if (!$isGameOpen) {
            // Remove unconfirmed rentals on the board game specified
            RentalRepository::deleteRentalByGameExceptStudent(
                $rental->boardGame->GameID,
                $rental->student->StudID
            );
        }

        return true;
    }

    static function adminRemoveRental(int $rentalId): bool
    {
        // When returned, remove rental entry
        return RentalRepository::deleteRentalById($rentalId);
    }

    static function getCurrentlyRentedByStudent(int $studentId): Rental|null
    {
        return RentalRepository::getRentalByUser($studentId);
    }
}


?>