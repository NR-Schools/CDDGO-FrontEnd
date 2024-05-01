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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+zEK5owl9aBMsoeixa0lsFbGCIjXoRSJo3I+NMm" crossorigin="anonymous">
    <style>

        .game-card-pic {
            width: 100%;
            height: 300px; 
            object-fit: cover; 
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }


        .game-card-body {
            padding: 20px;
            text-align: justify;
        }

        .game-card-title {
            margin-top: 0;
        }

        .game-card-text {
            margin-bottom: 15px;
        }


        .game-item-title {
            font-family: 'Alice',sans-serif;
            text-align: center;
            color: #1EA36D;
        }

        .game-card-container {
            margin: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); 
            gap: 40px;
            padding: 50px; 
        }

        .game-card {
            border: 1px solid #ccc;
            padding: 20px;
            transition: transform 1s;
        }

        .game-card:hover {
            box-shadow: 0 0 5px #9e0671;
            transform: scale(1.05,1.05);
        }


        .game-btn {
            background-color: #9e0671; 
            color: white;
            padding: 10px;
            border-radius: 4px;
        }
        .game-btn:hover {
            background-color: #9e0671; 
            color: white;
            padding: 10px;
        }


    </style>
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