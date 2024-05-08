<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/RentalService.php";

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    header("Location: /");
}
?>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove'])) {
        $rentalId = $_POST['rentalId'];

        // Remove Rental
        RentalService::adminRemoveRental($rentalId);
    } else if (isset($_POST['confirm'])) {
        $rentalId = $_POST['rentalId'];

        echo "<script> alert(1); </script>";

        // Confirm Rental
        RentalService::adminConfirmRental($rentalId);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTG - Manage Borrow Records</title>
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
        <p>ACTIVE RENTALS</p>
    </div>

    <div class="reservation-main-container">
        <div class="reservation-title">
            Confirmed Rentals
        </div>

        <div class="reservation-list-container">
            <?php
            // Get all rentals
            $rentals = RentalService::getAllConfirmedRentals();
            foreach ($rentals as $rental) {
                assert($rental instanceof Rental);
                echo <<<EOD
                <form class="reservation-entry" method="post" action="admin-manage_borrow_records.php">
                    <div>
                        <div>
                            <span> ID: {$rental->RentalID} </span>
                            <span> {$rental->student->StudID} </span>
                        </div>
                        <div>
                            <span> {$rental->boardGame->GameName} </span>
                        </div>
                        <div>
                            <span> Date: {$rental->BorrowDate} </span>
                            <span> Fee: P {$rental->Rent} </span>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" name="rentalId" value="{$rental->RentalID}"> 
                        <input type="submit" class="confirm-btn" name="remove" value="Delete">
                    </div>
                </form>
                EOD;
            }
            ?>
        </div>
    </div>

    <br>
    <br>

    <div class="reservation-main-container-2">
        <div class="reservation-title">
            Unconfirmed Rentals
        </div>

        <div class="reservation-list-container">
            <?php
            // Get all rentals
            $rentals = RentalService::getAllUnconfirmedRentals();
            foreach ($rentals as $rental) {
                assert($rental instanceof Rental);
                echo <<<EOD
                    <form class="reservation-entry" method="post" action="admin-manage_borrow_records.php">
                    <div>
                        <div>
                            <span> ID: {$rental->RentalID} </span>
                            <span> {$rental->student->StudID} </span>
                        </div>
                        <div>
                            <span> {$rental->boardGame->GameName} </span>
                        </div>
                        <div>
                            <span> Date: {$rental->BorrowDate} </span>
                            <span> Fee: P {$rental->Rent} </span>
                        </div>
                    </div>
                        <div>
                            <input type="hidden" name="rentalId" value="{$rental->RentalID}"> 
                            <input type="submit" name="confirm" value="Confirm" class="confirm-btn">
                        </div>
                    </form>
                    EOD;
            }
            ?>
        </div>
    </div>

    <!-- Include Footer -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php"; ?>

</body>

</html>