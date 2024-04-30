<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/services/ReservationService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    header("Location: /");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations</title>
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_reservations.css">
</head>

<body>
    <!-- Include Header -->
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Start Body -->
    <div class="main-body">
        <p>ACTIVE RESERVATIONS</p>
        <hr />


        <?php

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $actionType = $_POST['actionType'];
            $reservationId = $_POST['reservationId'];

            if ($actionType === "DELETE") {
                ReservationService::deleteReservation($reservationId);
            }
        }

        // Get all rentals
        $reservations = ReservationService::getAllReservations();

        foreach ($reservations as $reservation) {
            assert($reservation instanceof Reservation);
            $selfLink = htmlentities($_SERVER['PHP_SELF']);

            echo <<<EOD
            <div class="reservation-entry">
                <div>
                    <span> {$reservation->ReservationID} </span>
                    <div>
                        <span> {$reservation->student->getFullName()} </span>
                        <span> {$reservation->student->StudNo} </span>
                    </div>
                    <span> {$reservation->boardGame->GameName} </span>
                    <span> {$reservation->ReservedDate} </span>
                    <span> P{$reservation->ReservationFee} </span>
                </div>
                <div>
                    <form action="{$selfLink}" method="post">
                        <input type="hidden" name="actionType" value="DELETE">
                        <input type="hidden" name="reservationId" value="{$reservation->ReservationID}">
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
            EOD;
        }

        ?>

    </div>
</body>

</html>