<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php";

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
    <link rel="stylesheet" href="../css/admin-homepage.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>

<body>

    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>

    <div class="main-container">
        <div class="men-container">
            <div class="admin-title">ADMIN MENU</div>
            <div class="divider"></div>
            <div>
                <a href="../templates/admin-manage_board_games.php"><button class="button-styling">MANAGE BOARD
                        GAMES</button></a>
            </div>
            <div>
                <a href="../templates/admin-manage_events.php"><button class="button-styling">MANAGE EVENTS</button></a>
            </div>
            <div>
                <a href="../templates/admin-manage_reservations.php"><button class="button-styling">MANAGE
                        RESERVATIONS</button></a>
            </div>
            <div>
                <a href="../templates/admin-manage_borrow_records.php"><button class="button-styling">MANAGE BORROW
                        RECORDS</button></a>
            </div>
            <div>
                <a href="../templates/admin-manage_inquiries.php"><button class="button-styling">MANAGE
                        INQUIRIES</button></a>
            </div>
            <div>
                <a href="../templates/admin-manage_users.php"><button class="button-styling">MANAGE USERS AND
                        MEMBERS</button></a>
            </div>
            <div>
                <a href="../templates/admin-manage_registrations.php"><button class="button-styling">MANAGE
                        REGISTRATION</button></a>
            </div>
            <div class="divider"></div>
        </div>
    </div>

    <!-- Include Footer -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php"; ?>


</body>

</html>