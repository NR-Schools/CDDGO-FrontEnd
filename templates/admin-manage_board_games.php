<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");


    //get All Board Games
    $games = BoardGameService::getAllBoardGames();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Board Games</title>
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_board_games.css">
</head>
<body>
    <!-- Include Header and Footer-->
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>
    
    <!-- Start Board Game Cards -->
    <div class="game-card-container">

    <?php
        if($games != 0)
        {
            foreach($games as $game)
            {
                assert($game instanceof BoardGame);

                //Output events
                echo '<div class="game-card" style="padding:0">';
                echo '<img class="game-card-pic" style="height:300px;min-width:300" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="event_image">';
                echo '<div class="game-card-body">';
                echo '<h4 class="game-card-title">' . $game->GameName . '</h4>';
                echo '<p class="game-card-text">' .$game->GameDescription . '</p>';
                echo '<p class="game-card-text">' .$game->GameCategory . '</p>';
                echo '<p class="game-card-text">' .$game->QuantityAvailable. '</p>';
                echo '<a href="/templates/admin-edit_board_game.php?gameId=' . $game->GameID . '" class="game-btn">Edit</a>';
                echo '</div>';
                echo '</div>';
            }
        }
    ?>
    </div>

</body>
</html>