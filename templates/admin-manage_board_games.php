<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Board Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Include Header and Footer-->
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>
    
    <!-- Start Body -->
    <div class="main-body">
        <p>ALL BOARD GAMES</p>
        <hr />

        <?php

        require_once $_SERVER['DOCUMENT_ROOT'] . "/services/EventService.php";

        // Get all events
        $games = BoardGameService::getAllBoardGames();

        foreach ($games as $game) {
            assert($game instanceof BoardGame);

            $editLink = "/admin-edit_board_game.php?eventId=" . $game->GameID;

            echo <<<EOD
            <div class="event-entry">
                <div>
                    <span> $game->GameName </span>
                    <span> $game->GameDescription </span>
                </div>
                <div>
                    <span></span>
                    <span> $game->GameCategory </span>
                    <span> $game->QuantityAvailable </span>
                    <span> $game->GameStatus </span>
                    <span></span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen"
                        viewBox="0 0 16 16">
                        <a href="$editLink">
                            <path
                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                        </a>
                    </svg>
                </div>
            </div>
            EOD;
        }

        ?>

    </div>

</body>
</html>