<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/ReservationModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/ReservationRepository.php";


class ReservationService
{
    static function addUserReservation(Reservation $reservation): bool
    {
        // Add checks on reservation
        return ReservationRepository::addNewReservation($reservation);
    }

    static function getAllReservations(): array
    {
        return ReservationRepository::getAllReservations();
    }

    // Add More Service Actions
}


?>