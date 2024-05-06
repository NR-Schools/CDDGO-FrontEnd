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
    <title>Document</title>
    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/admin-edit_event.css">
</head>
<body>
    <!-- Include Header -->
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Edit/Delete Event -->
    <?php

        if(isset($_GET['eventId'])) {
            $eventId = $_GET['eventId'];
            $event = EventService::getEventById($eventId);
            if($event == null){
                echo "<script> alert('Invalid Event');
                </script>";
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['edit'])) {

                $eventID = $_POST['eventID'];
                $event = EventService::getEventById($eventID);
 
                $newImage = file_get_contents($_FILES['newImage']['tmp_name']);
                $newImageEncoded = base64_encode($newImage);

                $dateposted = date('Y-m-d H:i:s');

                $event->EventName = $_POST['newName'];
                $event->EventLocation = $_POST['newLocation'];
                $event->EventDate = $_POST['newDate'];
                $event->EventImage = $newImageEncoded;
                $event->EventDescription = $_POST['newDescription'];
                $event->DatePosted = $dateposted;

                EventService::updateEvent($event);

                echo "<script> alert('Event Updated');
                document.location.href = 'admin-manage_events.php';
                </script>";
            }
            elseif(isset($_POST['delete'])) {
                $eventID = $_POST['eventID'];
                EventService::deleteEvent($_POST['eventID']);

                echo "<script> alert('Event Deleted');
                document.location.href = 'admin-manage_events.php';
                </script>";
            }
        }
    ?>

    <!-- Start Body -->
    <div class="content-container">
        <div class="edit-event-title">
            <p>EDIT EVENT</p>
        </div>
        <form action="admin-edit_event.php" method="POST" enctype="multipart/form-data" class="row g-3">
            <div class="form-group">
                <label class="form-label" for="newName">Event Name</label>
                <input type="text" class="form-control" id="newName" name="newName" value="<?php echo $event->EventName; ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="newLocation">Edit Location</label>
                <input type="text" class="form-control" id="newLocation" name="newLocation" value="<?php echo $event->EventLocation; ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="newDate">Event Date</label>
                <input type="date" class="form-control" id="newDate" name="newDate" value="<?php echo $event->EventDate; ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="newImage">Event Image</label>
                <input class="form-control" type="file" id="newImage" name="newImage" onchange="onFileSelected(event)" accept="image/*">
            </div>
            <div class="form-group">
                <label for="newDescription" class="form-label">Description</label>
                <textarea class="form-control" id="newDescription" name="newDescription" rows="8"><?php echo $event->EventDescription; ?></textarea>
            </div>
            <div class="button-container text-center">
                <input type="hidden" name="eventID" id="eventID" value="<?php echo $eventId; ?>"> 
                <button type="sumbit" class="btn-edit" name="edit" value="edit">APPLY CHANGES</button>
                <button type="submit" class="btn-delete" name="delete" value="delete">REMOVE EVENT</button>
            </div>
        </form>
    </div>
</body>
</html>