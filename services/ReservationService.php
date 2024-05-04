<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/ReservationModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/ReservationRepository.php";


class ReservationService
{
    static function addUserReservation(Reservation $reservation): bool
    {
        // Check if user already has reservation for that game and date
        if (ReservationRepository::isReservationAttemptValid(
            $reservation->student->StudID,
            $reservation->boardGame->GameID,
            $reservation->ReservedDate
        )) return false;

        // Add Reservation by User
        ReservationRepository::addNewReservation($reservation);
        return true;
    }

    static function getAllConfirmedReservations(): array
    {
        return ReservationRepository::getAllReservations(true);
    }

    static function getAllUnconfirmedReservations(): array
    {
        return ReservationRepository::getAllReservations(false);
    }

    static function adminConfirmReservation(int $reservationId): bool
    {
        $reservation = ReservationRepository::getReservationById($reservationId);

        // Update Reservation, make it confirmed
        $reservation->isPaid = true;
        ReservationRepository::updateReservation($reservation);

        // Remove unconfirmed reservations on the board game specified
        ReservationRepository::deleteReservationByGameExceptStudent(
            $reservation->boardGame->GameID,
            $reservation->student->StudID,
            $reservation->ReservedDate
        );
        return true;
    }

    static function adminMoveReservationSchedule(int $reservationId, string $newDate): bool
    {
        // Check if new date for reservation does not have the same game being reserved by any student
        // Check if new date for reservation does not have the same user having a reservation record on that date
        // Change reservation date

        // WILL REMAIN TO BE UNIMPLEMENTED UNTIL FURTHER NOTICE
    }
}


?>