<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/RentalService.php";

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    //header("Location: /");
}

?>


<?php

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(isset($_POST['remove']))
    {
        $rentalId = $_POST['rentalId'];

        // Remove Rental
        RentalService::adminRemoveRental($rentalId);
    }

    else if (isset($_POST['confirm']))
    {
        $rentalId = $_POST['rentalId'];

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
</head>

<body>
    <!-- Include Header -->
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Start Body -->
    <div class="main-body">
        <p>ACTIVE RENTALS</p>
        <hr />


        <div class="rentals-container">
            <p>Confirmed Rentals</p>
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
                            <button type="button" name="remove" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                    EOD;
                }
                ?>
                
            </div>
        </div>

        <br>
        <br>
        <br>


        <div class="rentals-container">
            <p>Unconfirmed Rentals</p>
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
                            <button type="button" name="confirm" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                    EOD;
                }
                ?>

            </div>
        </div>

    </div>
</body>

</html>