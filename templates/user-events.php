<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/EventService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

    if (!AuthGuard::guard_route(Role::USER)) {
        // Return to root
        header("Location: /");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/user-events.css">
</head>
<body>
    <!-- Include Header -->
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Start Body -->
    <div class="main-container">
            <div class="event-title">
                ALL EVENTS
            </div>
            <div class="divider-container">
                <div class="divider"></div>
            </div>


            <?php

            // Get all events
            $events = EventService::getAllEvents();

            foreach ($events as $event) {
                assert($event instanceof Event);

                echo <<<EOD

                <div class="card mb-3">
                    <img src="data:image/{$event->EventImage};base64,{$event->EventImage}" id="event_image" class="card-img-top custom-card-img img-styling" alt="...">
                    <div class="card-body">
                        <h5 class="title-styling">{$event->EventName}</h5>
                        <p class="card-text">{$event->EventDescription}</p>
                        <div class="info-styling">
                            Location: <span class="value-styling">{$event->EventLocation}</span>
                        </div>
                        <div class="info-styling">
                            Event Date: <span class="value-styling">{$event->EventDate}</span>
                        </div> 
                        <p class="card-text date-posted"><small class="text-body-secondary">Last Updated: {$event->DatePosted}</small></p>
                    </div>
                </div>
                EOD;
            }

            ?>
    </div>
</body>
</html>