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
    <title>Manage Borrow Records</title>
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_borrow_records.css">
</head>

<body>
    <!-- Include Header -->
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Start Body -->
    <div class="main-body">
        <p>ACTIVE TRANSACTIONS</p>
        <hr />


        <?php

        require_once $_SERVER['DOCUMENT_ROOT'] . "/services/RentalService.php";

        // Get all rentals
        $rentals = RentalService::getAllRentals();

        foreach ($rentals as $rental) {
            assert($rental instanceof Rental);

            echo <<<EOD
            <div class="borrow-record-entry">
                <div>
                    <span> {$rental->RentalID} </span>
                    <span> {$rental->student->StudNo} </span>
                    <span> {$rental->boardGame->GameName} </span>
                    <span> {$rental->BorrowDate} </span>
                    <span> P {$rental->Rent} </span>
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