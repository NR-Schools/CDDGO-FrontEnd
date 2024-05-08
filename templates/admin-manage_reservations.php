<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/services/ReservationService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    header("Location: /");
}
?>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Remove'])) {
        $reservationId = $_POST['reservationId'];

        // Remove Reservation
        ReservationService::adminRemoveReservation($reservationId);
    } else if (isset($_POST['Confirm'])) {
        $reservationId = $_POST['reservationId'];

        // Confirm Reservation
        ReservationService::adminConfirmReservation($reservationId);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations</title>
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_reservations.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>

    <!-- Start Body -->
    <div class="reservations-title">
        <p>ACTIVE RESERVATIONS</p>
    </div>

    <div class="reservation-main-container">
        <div class="reservation-title">
            Confirmed Reservations
        </div>

        <div class="reservation-list-container">
            <?php
            $confirmedReservations = ReservationService::getAllConfirmedReservations();
            foreach ($confirmedReservations as $confirmedReservation) {
                assert($confirmedReservation instanceof Reservation);
                echo <<<EOD
            <div class="reservation-entry">
                <div>
                    <div>
                        <span> {$confirmedReservation->ReservationID} </span>
                    </div>
                    <div>
                        <span> {$confirmedReservation->student->getFullName()} </span>
                        <span> {$confirmedReservation->student->StudNo} </span>
                    </div>
                    <div>
                        <span> {$confirmedReservation->boardGame->GameName} </span>
                    </div>
                    <div>
                        <span> Date: {$confirmedReservation->ReservedDate} </span>
                        <span> Fee: P {$confirmedReservation->ReservationFee} </span>
                    </div>
                </div>
                <div>
                    <form action="admin-manage_reservations.php" method="post">
                        <input type="hidden" name="reservationId" value="{$confirmedReservation->ReservationID}">
                        <input type="submit" name="Remove" value="Remove" class="confirm-btn">
                    </form>
                </div>
            </div>
            EOD;
            }
            ?>
        </div>
    </div>

    <br>
    <br>

    <div class="reservation-main-container-2">
        <div class="reservation-title">
            Unconfirmed Reservations
        </div>
        <div class="reservation-list-container">

            <?php

            $unconfirmedReservations = ReservationService::getAllUnconfirmedReservations();
            foreach ($unconfirmedReservations as $unconfirmedReservation) {
                assert($unconfirmedReservation instanceof Reservation);
                echo <<<EOD
                <div class="reservation-entry">
                    <div>
                        <div>
                            <span> {$unconfirmedReservation->ReservationID} </span>
                        </div>
                        <div>
                            <span> {$unconfirmedReservation->student->getFullName()} </span>
                            <span> {$unconfirmedReservation->student->StudNo} </span>
                        </div>
                        <div>
                            <span> {$unconfirmedReservation->boardGame->GameName} </span>
                        </div>
                        <div>
                            <span> Date: {$unconfirmedReservation->ReservedDate} </span>
                            <span> Fee: P {$unconfirmedReservation->ReservationFee} </span>
                        </div>
                    </div>
                    <div>
                        <form action="admin-manage_reservations.php" method="post">
                            <input type="hidden" name="reservationId" value="{$unconfirmedReservation->ReservationID}">
                            <input type="submit" name="Confirm" value="CONFIRM" class="confirm-btn">
                        </form>
                    </div>
                </div>
                EOD;
            }

            ?>
        </div>
    </div>


    <!-- Include Footer -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php"; ?>

</body>

</html>