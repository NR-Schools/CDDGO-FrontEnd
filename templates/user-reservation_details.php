<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");

    if(isset($_GET["gameId"]))
    {
        $gameID = $_GET["gameId"];

        $game = BoardGameService::getBoardGameById($gameID);
        if ($game == null)
        {
            echo "No game.";
        }
        
    }

    //get all students
    [$email, $role] = AuthService::getCurrentlyLoggedIn();
    echo $email;

    //get all board games
    $games = BoardGameService::getAllBoardGames();

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['reserve'])){
            // Check if user already has reservation for that game
            
            // Check if user already has reservations for that date
            // Add Reservation by User

        }

        if(isset($_POST['cancel']))
        {
            $id = $_POST["gameID"];
            header("Location:../templates/user-board_game_details.php?gameId=". $id);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user-reservation-details.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>
    <form action="user-reservation_details.php" method="POST">
        <div class="main-container">
            <div class="reservation-container">
                <div class="title-styling">
                    RESERVATION DETAILS
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
                <div class="date-container">
                    <div class="label-styling" name="date">
                        Select Date
                    </div>
                    <div>
                        <input class="date-input" type="date">
                    </div>
                </div>
                <div class="divider"></div>
                <div class="button-container">
                    <input type="hidden" name="gameID" value="<?php echo $gameID; ?>">
                    <button class="reserve-game-button" name="reserve">RESERVE GAME</button>
                    <button class="cancel-button" name="cancel">CANCEL</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>