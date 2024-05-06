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
    <link type="text/css" rel="stylesheet" href="../css/user-board_games.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Include Header and Footer-->
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
        $searchClicked = false;
        
    ?>
    
    <div class="main-container">
        <div class="content-container">
            <div class="search-container">
                <form action="user-board_games.php" method="POST">
                    <input class="search-input" type="text" name="search" id="search" placeholder="Search Games...">
                    <button class="button-styling" type="submit" name="searchButton">Search</button>
                </form>
            </div>
            <div class="filters">
                <form action="user-board_games.php" method="POST">
                        <div>
                            <select class="filter-styling" name="filters" id="filters">
                                <option value="No Category">Select Category</option>
                                <option value="All">All</option>
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
                        </div>
                        <div style="text-align:center;margin-top:8px">
                            <button class="filter-button" type="submit" name="filterCategory">Filter</button>
                        </div>    
                </form>
            </div>
            <div class="main-title-styling">
                AVAILABLE BOARD GAMES
            </div>
            <div class="divider-container">
                <div class="divider"></div>
            </div>
            <div class="board-game-container">
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') 
                {
                    if(isset($_POST["searchButton"])){
                        $query = $_POST["search"];
                        $foundGame = false;
                        foreach($games as $game) 
                        {
                            if(strtolower($game->GameName) === strtolower($query)) 
                            {
                                echo <<< EOD
                                    <div class="game-card-container">
                                        <div class="board-name-container">
                                            {$game->GameName}
                                            <span class="game-cat">{$game->GameCategory}</span>
                                        </div>
                                EOD;
                                echo '<img class="img-styling" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                                echo <<< EOD
                                        <div class="status-container">
                                            {$game->GameStatus}
                                        </div>
                                        <div class=view-button-container>
                                            <a href="/templates/user-board_game_details.php?gameId={$game->GameID}" class="game-btn">
                                                <button class="view-button-styling">View</button>
                                            </a>
                                        </div>
                                    </div>
                                EOD;
                                $foundGame = true;
                            }
                        }
                        if (!$foundGame) {
                            echo <<< EOD
                                <div class="no-events">
                                    <div class="no-event-styling">
                                        Board Game Not Found.
                                    </div>
                                    <div class="no-event-desc">
                                        Oops! the game you have searched is not in our inventory
                                    </div>
                                </div>
                            EOD;
                        }
                    } 
                    if (isset($_POST["filterCategory"]))
                    {
                        $filter = $_POST["filters"];

                        $filteredGame = false;

                        if($filter == 'All'){
                            foreach($games as $game) 
                            {
                                echo <<< EOD
                                    <div class="game-card-container">
                                        <div class="board-name-container">
                                            {$game->GameName}
                                            <span class="game-cat">{$game->GameCategory}</span>
                                        </div>
                                EOD;
                                echo '<img class="img-styling" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                                echo <<< EOD
                                        <div class="status-container">
                                            {$game->GameStatus}
                                        </div>
                                        <div class=view-button-container>
                                            <a href="/templates/user-board_game_details.php?gameId={$game->GameID}" class="game-btn">
                                                <button class="view-button-styling">View</button>
                                            </a>
                                        </div>
                                    </div>
                                EOD;    
                            }
                        }
                        else
                        {
                            foreach($games as $game) 
                            {
                
                                if($game->GameCategory === $filter) 
                                {
                                    echo <<< EOD
                                        <div class="game-card-container">
                                            <div class="board-name-container">
                                                {$game->GameName}
                                                <span class="game-cat">{$game->GameCategory}</span>
                                            </div>
                                    EOD;
                                    echo '<img class="img-styling" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                                    echo <<< EOD
                                            <div class="status-container">
                                                {$game->GameStatus}
                                            </div>
                                            <div class=view-button-container>
                                                <a href="/templates/user-board_game_details.php?gameId={$game->GameID}" class="game-btn">
                                                    <button class="view-button-styling">View</button>
                                                </a>
                                            </div>
                                        </div>
                                    EOD;
                                    $filteredGame = true;
                                }
                            }

                            if (!$filteredGame) {
                                echo <<< EOD
                                    <div class="no-events">
                                        <div class="no-event-styling">
                                            Board Game Not Found.
                                        </div>
                                        <div class="no-event-desc">
                                            Oops! the game you have searched is not in our inventory
                                        </div>
                                    </div>
                                EOD;
                            }
                        }
                    }  

                }else {
                    if($games != 0) {
                        foreach($games as $game) 
                        {
                            echo <<< EOD
                                <div class="game-card-container">
                                    <div class="board-name-container">
                                        {$game->GameName}
                                        <span class="game-cat">{$game->GameCategory}</span>
                                    </div>
                            EOD;
                            echo '<img class="img-styling" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                            echo <<< EOD
                                    <div class="status-container">
                                        {$game->GameStatus}
                                    </div>
                                    <div class=view-button-container>
                                        <a href="/templates/user-board_game_details.php?gameId={$game->GameID}" class="game-btn">
                                            <button class="view-button-styling">View</button>
                                        </a>
                                    </div>
                                </div>
                            EOD;    
                        }
                    } else {
                        echo <<< EOD
                            <div class="no-events">
                                <div class="no-event-styling">
                                    Board Game Not Found.
                                </div>
                                <div class="no-event-desc">
                                    Oops! the game you have searched is not in our inventory
                                </div>
                            </div>
                        EOD;
                    }
                }
            
            ?>    
            </div>
            <div class="divider-container">
                <div class="divider"></div>
            </div>
        </div>
    </div>


    
</body>
</html>