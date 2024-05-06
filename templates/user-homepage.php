<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/services/StudentService.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/services/EventService.php");
    require_once($_SERVER['DOCUMENT_ROOT']. "/services/ReservationService.php");

    //Extracting the rented boardgame
    [$email, $role] = AuthService::getCurrentlyLoggedIn();
    $getRentedBoardGame = BoardGameService::getCurrentlyRentedBoardGame($email);
    $events = EventService::getAllEvents();
    $reservations = ReservationService::getAllConfirmedReservations();
    $student = StudentService::getStudentByEmail($email);
    $studReserveGame = ReservationService::getAllReservationsByStudent($student->StudID);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user-homepage.css">
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

        <div class="main-container">
            <div class="game-content-container">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="board-game-content">
                            <div class="title-styling">CURRENTLY RENTED GAME</div>
                            <div>
                                <?php 
                                    if(empty($getRentedBoardGame)){
                                        echo '<img class="img-styling" src="../assets/img-placeholder.png">';
                                    }else{
                                        echo '<img class="img-styling" src="data:image/' . pathinfo($getRentedBoardGame->GameImage, PATHINFO_EXTENSION) . ';base64,' . $getRentedBoardGame->GameImage . '>';
                                    }
                                ?>
                            </div>
                            <div class="board-game-info">
                                <div class="game-name-styling" name="gName">
                                    <?php 
                                    if(empty($getRentedBoardGame)){
                                        echo "No Board Game";
                                    }else{
                                        echo $getRentedBoardGame->GameName;
                                    }
                                    ?>
                                </div>
                                <div class="date-styling"></div>
                                <div class="date-styling" name="rDate">
                                    <?php 
                                        if(empty($getRentedBoardGame)){
                                            echo "No Return Date";
                                        }else{
                                            echo $getRentRecord->BorrowDate;
                                        }
                                    ?>
                                </div>
                            </div>
                    </div>
                </form>
                <div class="reservation-content-container">
                    <div class="title-styling">MY RESERVED GAMES</div>
                    <div class="divider"></div>
                    <?php 
                        
                        if(empty($studReserveGame)){
                            echo <<< EOD
                            <div class="no-events">
                                <div class="no-event-styling">
                                    You Have No Reserved Games
                                </div>
                                <div class="no-event-desc">
                                    Pay the Reservation Fee to Get Confirmed
                                </div>
                            </div>
                            EOD;
                        }else{
                        echo '<div class = "scroll">';
                            foreach($studReserveGame as $reservedGame){
                                echo<<<EOD
                                    <div class="reserve-container">
                                        <div>
                                            <div class="name-styling">
                                                {$reservedGame->boardGame->GameName}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="name-styling">
                                                {$reservedGame->ReservedDate}
                                            </div>
                                        </div>
                                    </div>                            
                                EOD;
                            }
                        echo '</div>';
                        }
                    ?>                    
                    <div class="divider"></div> 
                </div>     
            </div> 
            <div class="event-content-container">
                <div class="title-styling">NEW EVENTS</div>
                <div class="view-button-container">
                    <a href="../templates/user-events.php"><button class="view-button">VIEW ALL EVENTS</button></a>
                </div> 
                <div class="divider"></div>
                <?php 
                    
                    if(empty($events)){
                        echo <<< EOD
                            <div class="no-events">
                                <div class="no-event-styling">
                                    No New Announcements
                                </div>
                                <div class="no-event-desc">
                                    Wait for the next MTG Event!
                                </div>
                            </div>
                        EOD;
                    }else{
                    echo  '<div class="with-events">';
                        for($i = 0; $i<count($events) ; $i++){
                            echo <<< EOD
                                <div class="event-container">
                                    <div>
                                        <div class="name-styling">
                                            {$events[$i]->EventName}
                                        </div>
                                        <div class="desc-styling">
                                            {$events[$i]->EventDescription}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="sub-name-styling">
                                        <span class="name-styling">DATE POSTED: </span>{$events[$i]->DatePosted}
                                        </div>
                                        <div class="sub-name-styling">
                                        <span class="name-styling">EVENT INFO: </span>{$events[$i]->EventDate} 
                                        ({$events[$i]->EventLocation})
                                        </div>
                                    </div>
                                </div>
                            EOD;
                        }
                    echo  '</div>';
                    }
                ?>
                <div class="divider"></div> 
            </div> 
        </div>
    </body>
</html>
