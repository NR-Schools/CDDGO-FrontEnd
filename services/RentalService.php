<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/RentalModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/RentalRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/BoardGameRepository.php";


class RentalService
{
    static function addUserRentsGame(Rental $rental): bool
    {
        // Check if student has an existing rental record
        // Check if game is available
        // Check for reservations by other users

        // Add rental
        RentalRepository::addNewRental($rental);

        return true;
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

        // Remove unconfirmed rentals on the board game specified
        RentalRepository::deleteRentalByGameExceptStudent(
            $rental->boardGame->GameID,
            $rental->student->StudID
        );

        return true;
    }

    static function adminRemoveRental(int $rentalId): bool
    {
        // When returned, remove rental entry
        return RentalRepository::deleteRentalById($rentalId);
    }
}


?>