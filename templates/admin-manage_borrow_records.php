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
    <title>Manage Borrow Records</title>
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_borrow_records.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>

    <!-- Start Body -->
    <div class="rentals-title">
        <p>ACTIVE RENTALS</p>
    </div>

    <div class="rental-main-container">
        <div class="rental-title">
            Confirmed Rentals
        </div>

        <div class="rentals-list-container">
            <?php
            // Get all rentals
            $rentals = RentalService::getAllConfirmedRentals();
            foreach ($rentals as $rental) {
                assert($rental instanceof Rental);
                echo <<<EOD
                <form class="borrow-record-entry" method="post" action="admin-manage_borrow_records.php">
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
                        <input type="submit" name="remove" value="Delete" class="btn btn-danger">
                    </div>
                </form>
                EOD;
            }
            ?>
        </div>
    </div>

    <br>
    <br>

    <div class="rental-main-container-2">
        <div class="rental-title">
            Unconfirmed Rentals
        </div>

        <div class="rentals-list-container">
            <?php
            // Get all rentals
            $rentals = RentalService::getAllUnconfirmedRentals();
            foreach ($rentals as $rental) {
                assert($rental instanceof Rental);
                echo <<<EOD
                    <form class="borrow-record-entry" method="post" action="admin-manage_borrow_records.php">
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
                            <input type="submit" name="confirm" value="Confirm" class="btn btn-primary">
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