<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");

    //get gameID
    if(isset($_GET["gameId"]))
    {
        $gameID = $_GET["gameId"];

        $game = BoardGameService::getBoardGameById($gameID);
        if ($game == null)
        {
            echo "No game.";
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Board Game Details</title>
</head>
<body>
        <!-- Include Header and Footer-->
        <?php 
            require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
            require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
        ?>

        <!--Form Start-->
        <form action="user-board_game_details.php" method="POST">
            <div class="main-container">
                <div class="rent-container">
                    <div class="title-styling">
                        BOARD GAME DETAILS
                    </div>
                    <div class="divider"></div>

                    <?php
                        echo<<<EOD
                        <div>
                            <img class="game-image" src="../assets/img-placeholder.png" alt="">
                        </div>
                        <div class="name-styling" name="gameName" id="gameName">{$game->GameName}</div>
                        <div class="price-styling" name="reservePrice" id="reservePrice">TOTAL PRICE</div>
                        EOD;
                    ?>

                
                </div>
            </div>
        </form>
        <!--Content Start-->
        <div class="content-container">
            <?php
                        // Output events for the found game
                        echo '<div class="game-card" style="padding:0">';
                        echo '<img class="game-card-pic" style="height:300px;min-width:300" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                        echo '<div class="game-card-body">';
                        echo '<h4 class="game-card-title">' . $game->GameName . '</h4>';
                        echo '<p class="game-card-text">' . $game->GameCategory . '</p>';
                        echo '<p class="game-card-text"> Quantity Available: ' . $game->QuantityAvailable . '</p>';
                        echo '<p class="game-card-text"> Overview: ' . $game->GameDescription . '</p>';
                        echo '<a href="/templates/user-board_game_details.php?gameId=' . $game->GameID . '" class="game-btn">Rent</a>';
                        echo '<a href="/templates/user-reservation_details.php?gameId=' . $game->GameID . '" class="game-btn">Reserve</a>';
                        echo '<a href="/templates/user-board_game_details.php?gameId=' . $game->GameID . '" class="game-btn">Back</a>';
                        echo '</div>';
                        echo '</div>';
            ?>
        </div>
        
</body>
</html>