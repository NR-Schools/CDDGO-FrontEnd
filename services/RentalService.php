<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/RentalModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/RentalRepository.php";


class RentalService
{
    static function addUserRentsGame(Rental $rental): bool
    {
        return RentalRepository::addNewRental($rental);
    }

    static function getAllRentals(): array
    {
        return RentalRepository::getAllRentals();
    }

    // Add More Service Actions
}


?>