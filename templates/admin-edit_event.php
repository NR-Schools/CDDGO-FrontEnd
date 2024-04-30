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
    <link type="text/css" rel="stylesheet" href="../css/admin-edit_event.css">
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
        <p>EVENT NAME</p>
        <hr />

        <!-- Loop This Shit -->
        <div class="fields-container">
        <form class="row g-3">
            <div class="col-md-6">
                <label class="form-label text-white" for="editTitle">Event Title</label>
                <div class="input-group">
                    <div class="input-group-text">Edit Icon</div>
                    <input type="text" class="form-control" id="editTitle">
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-white" for="editLocation">Edit Location</label>
                <div class="input-group">
                    <div class="input-group-text">Edit Icon</div>
                    <input type="text" class="form-control" id="editLocation">
                </div>
            </div>
            <div class="col-6">
                <label class="form-label text-white" for="editDate">Event Date</label>
                <div class="input-group">
                    <div class="input-group-text">Edit Icon</div>
                    <input type="text" class="form-control" id="editDate">
                </div>
            </div>
            <div class="col-12">
                <label for="editDescription" class="form-label text-white">Description</label>
                <div class="input-group">
                    <div class="input-group-text">Edit Icon</div>
                    <textarea class="form-control" id="editDescription" rows="8"></textarea>
                </div>
                
            </div>
        </form>
        </div>

        <hr />

        <div class="button-container">
            <button type="button" class="btn">APPLY CHANGES</button>
            <button type="button" class="btn">REMOVE EVENT</button>
        </div>

    </div>
</body>
</html>