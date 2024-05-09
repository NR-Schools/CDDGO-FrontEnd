<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");


if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    header("Location: /");
}


//get All Board Games
$games = BoardGameService::getAllBoardGames();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTG - Manage Board Games</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_board_games.css">

</head>

<body>

    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php"; ?>
<div class="main-container">
    <!-- Start Board Game Cards -->
    <div class="title-container">
        <div class="title">
            ALL BOARD GAMES
        </div>
    </div>
    <div class="add-button">
        <a href="admin-add_board_game.php">
            <button class="add-btn-2">ADD NEW BOARD GAME</button>
        </a>
    </div>

    <div class="game-card-container">

        <?php
        if ($games != 0) {
            foreach ($games as $game) {
                assert($game instanceof BoardGame);

                //Output events
                echo '<div class="game-card" style="padding:0">';
                echo '<img class="game-card-pic" style="height:300px;min-width:300" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="event_image">';
                echo '<div class="game-card-body">';
                echo '<h4 class="game-card-title">' . $game->GameName . '</h4>';
                echo '<p class="game-card-desc">' . $game->GameDescription . '</p>';
                echo '<p class="game-card-text">' . $game->GameCategory . '</p>';
                echo '<p class="game-card-text">' . $game->QuantityAvailable . '</p>';
                echo '</div>';
                echo '<a class="button-container" href="/templates/admin-edit_board_game.php?gameId=' . $game->GameID . '">';
                echo '<button class="add-btn">Edit</button>';
                echo '</a>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>


</body>

</html>