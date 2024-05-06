<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/EventService.php");
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
    <title>Add Event</title>
    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/admin-add_event.css">
</head>
<body>
    <!-- Include Header -->
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Start Body -->
    <div class="content-container">
        <div class="add-event-title">
        <p>ADD EVENT</p>
        </div>
        
        <!-- Loop This Shit -->
        <form action="admin-add_event.php" method="POST" enctype="multipart/form-data" class="row g-3">
            <!-- Event Title/Name -->
            <div class="form-group">
                <label for="inputName" class="form-label">Event Title</label>
                <input type="text" class="form-control" id="inputName" name="inputName">
            </div>

            <!-- Event Location -->
            <div class="form-group">
                <label for="inputLocation" class="form-label">Location</label>
                <input type="text" class="form-control" id="inputLocation" name="inputLocation">
            </div>
            
            <!-- Event Date -->
            <div class="form-group">
                <label for="inputDate" class="form-label">Event Date</label>
                <input type="date" class="form-control" id="inputDate" name="inputDate">
            </div>

            <!-- Event Image -->
            <div class="form-group">
                <label for="inputImage" class="form-label">Event Image</label>
                <input class="form-control" type="file" id="inputImage" name="inputImage" onchange="onFileSelected(event)" accept="image/*">
            </div>

            <!-- Event Description -->
            <div class="form-group">
                <label for="inputDescription" class="form-label">Description</label>
                <textarea type="text" class="form-control" id="inputDescription" rows="8" name="inputDescription"></textarea>
            </div>

            <div class="button-container text-center">
                <button type="submit" class="btn-submit">ADD EVENT</button>
                <button onclick="window.location.href='admin-manage_events.php'" type="button" class="btn-cancel">CANCEL</button>
            </div>
        </form>
    </div>

    <!-- Add Event -->
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $inputImage = file_get_contents($_FILES['inputImage']['tmp_name']);
            $inputImageEncoded = base64_encode($inputImage);

            $dateposted = date('Y-m-d H:i:s');

            $event = new Event();

            $event->EventName = $_POST['inputName'];
            $event->EventLocation = $_POST['inputLocation'];
            $event->EventDate = $_POST['inputDate'];
            $event->EventImage = $inputImageEncoded;
            $event->EventDescription = $_POST['inputDescription'];
            $event->DatePosted = $dateposted;

            EventService::addEvent($event);

            echo "<script> alert('Event Added');
            document.location.href = 'admin-manage_events.php';
            </script>";
        }
    ?>
</body>
</html>