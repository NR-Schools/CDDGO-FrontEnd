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
    <link rel="stylesheet" href="../css/user-board_game_details.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Board Game Details</title>
</head>
<body>
        <!-- Include Header and Footer-->
        <?php 
            require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
            require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
        ?>

<<<<<<< Updated upstream
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
=======
        <!--Content Start For non-members-->
        <div class="main-container">
            <div class="left-column">
                <div class="img-container">
                    <img class="img-styling" src="../assets/img-placeholder.png" alt="">
                </div>
                <div class="title-styling">
                    Reviews
                </div>
                <div class="divider"></div>
                <div class="reviews-container">
                    <div class="review-content">
                        <div class="author-styling">
                            Author(Position)
                        </div>
                        <div class="testimony-review">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium praesentium nulla magnam magni quam similique fugit minus, tempore veritatis mollitia error dolore impedit atque. Nemo, provident non blanditiis eveniet vitae et facere ipsam a error dolorem ratione magni repudiandae reiciendis nesciunt dolore sunt obcaecati molestiae! Omnis labore, error ad placeat quasi nobis nisi! Id nam velit esse maxime neque, modi saepe veritatis, natus fugiat quia commodi, animi reiciendis. Adipisci, sunt quibusdam modi excepturi est soluta eaque, vero nobis eligendi architecto atque dolores voluptates accusamus sequi cumque quaerat voluptatibus corrupti. Officia reiciendis dolorum rerum inventore repellat hic earum expedita eveniet beatae.
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-column">
                <div class="game-name-styling">
                    Board Game Name
                </div>
                <div class="game-info">
                    <div class="category-styling">
                        Category
                    </div>
                    <div class="info-styling">
                        Rent Price: <span class="value-styling">₱100.00</span>
                    </div>
                    <div class="info-styling">
                        Rent Price: <span class="value-styling">5.0</span>
                    </div>
                </div>
                <div class="title-styling">
                    Overview
                </div>
                <div class="text-content">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium, vel.
                </div>
                <div class="title-styling">
                    How To Play
                </div>
                <div class="text-content">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium, vel.
                </div>
                <div class="button-container">
                    <button class="reserve-button">RESERVE THIS GAME</button>
                    <button class="rent-button">RENT THIS GAME</button>
                </div>
                <div class="back-button-container">
                    <button class="back-button">BACK</button>
                </div>
            </div>
        </div>
















        <!--
>>>>>>> Stashed changes
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
        -->
        
</body>
</html>