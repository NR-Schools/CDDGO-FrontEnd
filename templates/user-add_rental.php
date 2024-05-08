<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/RentalService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/ReservationService.php");
        
    if (!AuthGuard::guard_route(Role::USER)) {
            // Return to root
            header("Location: /");
        }
?>