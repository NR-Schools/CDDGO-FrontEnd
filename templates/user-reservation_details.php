<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/ReservationService.php");

    if (!AuthGuard::guard_route(Role::USER)) {
        // Return to root
        header("Location: /");
    }


    
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['reserve'])){
            // Check if user is making a duplicate reservation
            $gameID = $_POST["gameID"];
            $game = BoardGameService::getBoardGameById($gameID);
            $date = $_POST["date"];
            $fee = 50;

            // Get logged student
            [$email, $role] = AuthService::getCurrentlyLoggedIn();
            $currentUser = StudentService::getStudentByEmail($email);

            $reservation = new Reservation();
            $reservation->ReservationFee = $fee;
            $reservation->ReservedDate = $date;
            $reservation->createOnlyStudentId($currentUser->StudID);
            $reservation->createOnlyBoardGameId($gameID);

            $result = ReservationService::addUserReservation($reservation);

            if (!$result) {
                // Reservation Failed!
                echo "<script> alert('Reservation Failed');
                document.location.href = 'user-board_games.php';
                </script>";
            }

            // Reservation Success!
            echo "<script> alert('Board Game Reserved');
            document.location.href = 'user-board_games.php';
            </script>";
        }

        if(isset($_POST['cancel']))
        {
            $id = $_POST["gameID"];
            header("Location:../templates/user-board_game_details.php?gameId=". $id);
        }
    }

    if(isset($_GET["gameId"]))
    {
        $gameID =(int)$_GET["gameId"];

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
                    echo '<div>';
                    echo '<img class="game-image" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                    echo '</div>';
                    echo '<div class="name-styling" name="gameName" id="gameName">'.$game->GameName.'</div>';
                    echo '<div class="price-styling" name="reservePrice" id="reservePrice">';
                    echo  'Reservation Fee: ₱50.00';
                    echo '</div>';
                ?>
                <div class="date-container">
                    <div class="label-styling" name="date">
                        Select Date
                    </div>
                    <div>
                        <input class="date-input" name="date" type="date">
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