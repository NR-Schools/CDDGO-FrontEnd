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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/user-events.css">
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
                    <p class="card-text date-posted"><small class="text-body-secondary">Date Posted: {$event->DatePosted}</small></p>
                </div>
            </div>
            EOD;
        }

        ?>

    </div>
</body>
</html>