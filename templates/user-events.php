<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/EventService.php";
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
    <link type="text/css" rel="stylesheet" href="../css/user-events.css">
</head>
<body>
    <!-- Include Header -->
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Start Body -->
    <div class="main-body">
        <p>ALL EVENTS</p>
        <hr />

        <?php

        // Get all events
        $events = EventService::getAllEvents();

        foreach ($events as $event) {
            assert($event instanceof Event);

            echo <<<EOD

            <div class="card mb-3">
                <img src="data:image/{$event->EventImage};base64,{$event->EventImage}" id="event_image" class="card-img-top custom-card-img" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{$event->EventName}</h5>
                    <p class="card-text">{$event->EventDescription}</p>
                    <p class="card-text">Location: {$event->EventLocation}</p>
                    <p class="card-text">Event Date: {$event->EventDate}</p>
                    <p class="card-text date-posted"><small class="text-body-secondary">Last Updated: {$event->DatePosted}</small></p>
                </div>
            </div>
            EOD;
        }

        ?>

    </div>
</body>
</html>