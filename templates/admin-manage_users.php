<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

    if (!AuthGuard::guard_route(Role::ADMIN)) {
        // Return to root
        // header("Location: /");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_users.css">
    <!-- JS -->
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
        <p>USER MANAGEMENT</p>
        <hr />

        <!-- Loop This Shit -->
        <div class="borrow-record-entry">
            <div>
                <span>STUDENT NUMBER</span>
                <span>USERNAME</span>
                <span>PASSWORD</span>
                <span>MEMBERSHIP</span>
            </div>
            <div>
                <button type="button" class="btn btn-danger">Edit</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>

        <div class="borrow-record-entry">
            <div>
                <span>STUDENT NUMBER</span>
                <span>USERNAME</span>
                <span>PASSWORD</span>
                <span>MEMBERSHIP</span>
            </div>
            <div>
                <button type="button" class="btn">Edit</button>
                <button type="button" class="btn">Delete</button>
            </div>
        </div>
    </div>
</body>
</html>