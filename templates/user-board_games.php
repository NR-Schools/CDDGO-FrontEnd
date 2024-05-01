<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");

    // Get All Board Games
    $games = BoardGameService::getAllBoardGames();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Board Games</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+zEK5owl9aBMsoeixa0lsFbGCIjXoRSJo3I+NMm" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_board_games.css">
</head>
<body>
    <!-- Include Header and Footer-->
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>
    
    <!-- Search Engine -->
    <div>
        <form action="user-board_games.php" method="POST">
            <input type="text" name="search" id="search" placeholder="Search...">
            <button type="submit">Search</button>
        </form>
    </div>
    
    <!-- Start Board Game Cards -->
    <div class="game-card-container">
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $query = $_POST["search"];

            $foundGame = false;

            foreach($games as $game) {

                if(strtolower($game->GameName) === strtolower($query)) {
                    // Output events for the found game
                    echo '<div class="game-card" style="padding:0">';
                    echo '<img class="game-card-pic" style="height:300px;min-width:300" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                    echo '<div class="game-card-body">';
                    echo '<h4 class="game-card-title">' . $game->GameName . '</h4>';
                    echo '<p class="game-card-text">' . $game->GameCategory . '</p>';
                    echo '<p class="game-card-text"> Quantity Available: ' . $game->QuantityAvailable . '</p>';
                    echo '<a href="/templates/user-board_game_details.php?gameId=' . $game->GameID . '" class="game-btn">Rent</a>';
                    echo '</div>';
                    echo '</div>';
                    $foundGame = true;
                }
            }
            
            if (!$foundGame) {
                echo "No games found.";
            }
        } else {
            if($games != 0) {
                foreach($games as $game) {
                    assert($game instanceof BoardGame);

                    // Output events for all games
                    echo '<div class="game-card" style="padding:0">';
                    echo '<img class="game-card-pic" style="height:300px;min-width:300" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                    echo '<div class="game-card-body">';
                    echo '<h4 class="game-card-title">' . $game->GameName . '</h4>';
                    echo '<p class="game-card-text">' .$game->GameCategory . '</p>';
                    echo '<p class="game-card-text"> Quantity Available: ' .$game->QuantityAvailable. '</p>';
                    echo '<a href="/templates/user-board_game_details.php?gameId=' . $game->GameID . '" class="game-btn">Rent</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No board games.";
            }
        }
    ?>
    </div>

</body>
</html>