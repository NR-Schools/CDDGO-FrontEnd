<?php

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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_reservations.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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

        require_once $_SERVER['DOCUMENT_ROOT'] . "/services/ReservationService.php";

        // Get all rentals
        $reservations = ReservationService::getAllReservations();

        foreach ($reservations as $reservation) {
            assert($reservation instanceof Reservation);

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
                    <span>P {$reservation->ReservationFee}</span>
                </div>
                <div>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
            EOD;
        }

        ?>

    </div>
</body>

</html>