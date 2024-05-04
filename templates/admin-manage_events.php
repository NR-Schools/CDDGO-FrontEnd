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
    <title>Manage Events</title>
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_events.css">
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

        <div class="custom-layout-manager">
            
            <?php

            require_once $_SERVER['DOCUMENT_ROOT'] . "/services/EventService.php";

            // Get all events
            $events = EventService::getAllEvents();
            foreach ($events as $event) {
                assert($event instanceof Event);
                $editLink = "/templates/admin-edit_event.php?eventId=" . $event->EventID;
                echo <<<EOD
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://placehold.co/600x400/png" alt="{Card image}">
                    <div class="card-body">
                        <h5 class="card-title">{$event->EventName}</h5>
                        <p class="card-text">{$event->EventDescription}</p>
                        <p class="card-text">Location: {$event->EventLocation}</p>
                        <p class="card-text">Event Date: {$event->EventDate}</p>
                        <a href="#" class="btn btn-primary">Edit Event</a>
                        <br />
                        <br />
                        <span class="card-subtitle mb-2 text-muted fs-6">{$event->DatePosted}</span>
                    </div>
                </div>
                EOD;
            }

            ?>

        </div>

    </div>
</body>

</html>