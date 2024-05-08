<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/EventService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/validator.php';

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    header("Location: /");
}
?>


<?php

if (isset($_GET['eventId'])) {
    $eventId = $_GET['eventId'];
    $event = EventService::getEventById($eventId);
    if ($event == null) {
        echo "<script> alert('Invalid Event');
            </script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit'])) {

        $eventID = $_POST['eventID'];
        $event = EventService::getEventById($eventID);

        // Perform Validation
        [$status, $error] = validate_many_inputs([
            ["EventName", $_POST['inputName'], [new MinLengthRule(5), new MaxLengthRule(20)]],
            ["EventLocation", $_POST['inputLocation'], [new MinLengthRule(5), new MaxLengthRule(20)]],
            ["EventDate", $_POST['inputDate'], [new MinLengthRule(1),]],
            ["EventDescription", $_POST['inputDescription'], [new MinLengthRule(5), new MaxLengthRule(20)]],
        ]);

        echo <<<EOD
        <script>
            alert('{$error}');
            document.location.href = '{$_SERVER['REQUEST_URI']}';
        </script>
        EOD;

        if ($status) {
            $event->EventName = $_POST['newName'];
            $event->EventLocation = $_POST['newLocation'];
            $event->EventDate = $_POST['newDate'];
            if (boolval($_FILES['newImage']['error'] === 0)) {
                $newImage = file_get_contents($_FILES['newImage']['tmp_name']);
                $newImageEncoded = base64_encode($newImage);
                $event->EventImage = $newImageEncoded;
            }
            $event->EventDescription = $_POST['newDescription'];
            $event->DatePosted = date('Y-m-d H:i:s');

            // Update Event
            EventService::updateEvent($event);

            echo <<<EOD
            <script>
                alert('Event Added');
                document.location.href = 'admin-manage_events.php';
            </script>
            EOD;
        }

    } elseif (isset($_POST['delete'])) {
        $eventID = $_POST['eventID'];
        EventService::deleteEvent($_POST['eventID']);

        echo "<script> alert('Event Deleted');
            document.location.href = 'admin-manage_events.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <link type="text/css" rel="stylesheet" href="../css/admin-edit_event.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- Start Body -->
    <div class="content-container">
        <div class="edit-event-title">
            <p>EDIT EVENT</p>
        </div>
        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data"
            class="row g-3">
            <div class="form-group">
                <label class="form-label" for="newName">Event Name</label>
                <input type="text" class="form-control" id="newName" name="newName"
                    value="<?php echo $event->EventName; ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="newLocation">Edit Location</label>
                <input type="text" class="form-control" id="newLocation" name="newLocation"
                    value="<?php echo $event->EventLocation; ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="newDate">Event Date</label>
                <input type="date" class="form-control" id="newDate" name="newDate"
                    value="<?php echo date('Y-m-d', strtotime($event->EventDate)); ?>">
            </div>
            <div class="form-group">
                <label class="form-label" for="newImage">Event Image</label>
                <input class="form-control" type="file" id="newImage" name="newImage" onchange="onFileSelected(event)"
                    accept="image/*">
            </div>
            <div class="form-group">
                <label for="newDescription" class="form-label">Description</label>
                <textarea class="form-control" id="newDescription" name="newDescription"
                    rows="8"><?php echo $event->EventDescription; ?></textarea>
            </div>
            <div class="button-container text-center">
                <input type="hidden" name="eventID" id="eventID" value="<?php echo $eventId; ?>">
                <button type="sumbit" class="btn-edit" name="edit" value="edit">Apply Changes</button>
                <button type="submit" class="btn-delete" name="delete" value="delete">Remove Event</button>
            </div>
        </form>
    </div>
</body>

</html>