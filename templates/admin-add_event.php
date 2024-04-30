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
    <link type="text/css" rel="stylesheet" href="../css/admin-add_event.css">
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
        <p>ADD EVENT</p>
        <hr />

        <!-- Loop This Shit -->
        <div class="fields-container">
        <form class="row g-3">
            <div class="col-md-6">
                <label for="inputTitle" class="form-label text-white">Event Title</label>
                <input type="text" class="form-control" id="inputTitle">
            </div>
            <div class="col-md-6">
                <label for="inputLocation" class="form-label text-white">Location</label>
                <input type="text" class="form-control" id="inputLocation">
            </div>
            <div class="col-6">
                <label for="inputDate" class="form-label text-white">Event Date</label>
                <input type="text" class="form-control" id="inputDate">
            </div>
            <div class="col-12">
                <label for="inputDescription" class="form-label text-white">Description</label>
                <textarea class="form-control" id="inputDescription" rows="8"></textarea>
            </div>
        </form>
        </div>

        <hr />

        <div class="button-container">
            <button type="button" class="btn">ADD EVENT</button>
            <button type="button" class="btn">CANCEL</button>
        </div>

    </div>
</body>
</html>