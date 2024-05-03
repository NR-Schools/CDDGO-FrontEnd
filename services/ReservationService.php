<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/ReservationModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/ReservationRepository.php";


class ReservationService
{
    static function addUserReservation(Reservation $reservation): bool
    {
        // Check if user already has reservation for that game
        // Check if user already has reservations for that date
        // Add Reservation by User
    }

    static function getAllConfirmedReservations(): array
    {
    }

    static function getAllUnconfirmedReservations(): array
    {
    }

    static function adminConfirmReservation(Reservation $reservation): bool
    {
        // Update Reservation, make it confirmed
        // Remove unconfirmed reservations on the board game specified
    }

    static function adminRemoveReservation(int $reservationId): bool
    {
        // when returned, remove reservation entry
    }
}


?>