<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/services/EventService.php";
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
    <title>Manage Events</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_board_games.css">
</head>

<body>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>
<div class="main-container">
    <!-- Start Board Game Cards -->
    <div class="title-container">
        <div class="title">
            ALL EVENTS
        </div>
    </div>
    <div class="add-button">
        <a href="/templates/admin-add_event.php">
            <button class="add-btn-2">ADD NEW EVENT</button>
        </a>
    </div>

    <div class="game-card-container">

        <?php
        $events = EventService::getAllEvents();
        if ($events != 0) {
            foreach ($events as $event) {
                assert($event instanceof Event);

                //Output events
                echo '<div class="game-card" style="padding:0">';
                echo '<img class="game-card-pic" style="height:300px;min-width:300" src="data:image/' . pathinfo($event->EventImage, PATHINFO_EXTENSION) . ';base64,' . $event->EventImage . '" id="event_image">';
                echo '<div class="game-card-body">';
                echo '<h4 class="game-card-title">' . $event->EventName . '</h4>';
                echo '<p class="game-card-desc">' . $event->EventDescription . '</p>';
                echo '<p class="game-card-text">' . $event->EventLocation . '</p>';
                echo '<p class="game-card-text">' . $event->EventDate . '</p>';
                echo '<p class="game-card-text">' . $event->DatePosted. '</p>';
                echo '</div>';
                echo '<a class="button-container" href="/templates/admin-edit_event.php?eventId=' . $event->EventID.'"><button class="add-btn">EDIT</button></a>';
                echo '</div>';



            }
        }
        ?>
    </div>
</div>

    <!-- Include Footer -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php"; ?>

</body>

</html>