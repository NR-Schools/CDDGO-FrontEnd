<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/RentalModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/RentalRepository.php";


class RentalService
{
    static function addUserRentsGame(Rental $rental): bool
    {
        // Check if student has an existing rental record
        // Check if game is available
        // Check for reservations
        // Add rental
    }

    static function getAllConfirmedRentals(): array
    {
        // Get all rentals (confirmed)
    }

    static function getAllUnconfirmedRentals(): array
    {
        // Get all rentals (unconfirmed)
    }

    static function adminConfirmRental(int $rentalId): bool
    {
        // Update Rental, make it confirmed
        // Remove unconfirmed rentals on the board game specified
        // Reduce Board Game Qty Available
    }

    static function adminRemoveRental(): bool
    {
        // When returned, remove rental entry
        // Add Board Game Qty
    }
}


?>