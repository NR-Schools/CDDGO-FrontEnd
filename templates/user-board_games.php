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
    <title>All Board Games</title>
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
    <div class="search engine">
        <form action="user-board_games.php" method="POST">
            <input type="text" name="search" id="search" placeholder="Search...">
            <button type="submit" name="searchButton">Search</button>
        </form>
    </div>

    <!-- Category Filters-->
    <div class="filters">
        <form action="user-board_games.php" method="POST">
            <label for="filters">Filter Category</label>
                <select name="filters" id="filters">
                    <option value="No Category">Select Category</option>
                    <option value="Abstract Strategy">Abstract Strategy</option>
                    <option value="Area Control">Area Control</option>
                    <option value="Campaign">Campaign</option>
                    <option value="City Building">City Building</option>
                    <option value="Cooperative">Cooperative</option>
                    <option value="Deck Building">Deck Building</option>
                    <option value="Deduction">Deduction</option>
                    <option value="Dexterity">Dexterity</option>
                    <option value="Dungeon Crawler">Dungeon Crawler</option>
                    <option value="Economic">Economic</option>
                    <option value="Family">Family</option>
                    <option value="Fighting">Fighting</option>
                    <option value="Hand Management">Hand Management</option>
                    <option value="Kid">Kid</option>
                    <option value="Limited Communication">Limited Communication</option>
                    <option value="Party">Party</option>
                    <option value="Pick-Up and Deliver">Pick-Up and Deliver</option>
                    <option value="Programming">Programming</option>
                    <option value="Set Collection">Set Collection</option>
                    <option value="Storytelling">Storytelling</option>
                    <option value="Tower Defense">Tower Defense</option>
                    <option value="War">War</option>
                    <option value="Word">Word</option>
                    <option value="Worker Placement">Worker Placement</option>
                </select>
            <button type="submit" name="filterCategory">Filter</button>
        </form>
    </div>
    
    <!-- Start Board Game Cards -->
    <div class="game-card-container">
    <?php
        //search engine
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            if (isset($_POST["searchButton"]))
            {
                $query = $_POST["search"];

                $foundGame = false;
    
                foreach($games as $game) 
                {
    
                    if(strtolower($game->GameName) === strtolower($query)) 
                    {
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
            }

            if (isset($_POST["filterCategory"]))
            {
                $filter = $_POST["filters"];

                $filteredGame = false;

                foreach($games as $game) 
                {
    
                    if($game->GameCategory === $filter) 
                    {
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
                        $filteredGame = true;
                    }
                }

                if (!$filteredGame) {
                    echo "No games found.";
                }


            }

           
        } 
        
        //Display all board games
        else {
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