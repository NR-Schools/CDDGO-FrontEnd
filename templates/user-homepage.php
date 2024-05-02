<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
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
                <div class="board-game-content">
                        <div class="title-styling">CURRENTLY RENTED GAME</div>
                        <div>
                            <img class="img-styling" src="../assets/img-placeholder.png" alt="">
                        </div>
                        <div class="board-game-info">
                            <div class="game-name-styling">BOARD GAME NAME</div>
                            <div class="date-styling">BORROW DATE</div>
                            <div class="date-styling">RETURN DATE</div>
                        </div>
                        <div class="button-container">
                            <button class="button-styling">CANCEL RENT</button>
                        </div>
                </div>
                <div class="event-content-container">
                        <div class="title-styling">NEW EVENTS</div>
                        <div class="view-button-container">
                            <button class="view-button">VIEW ALL EVENTS</button>
                        </div> 
                        <div class="divider"></div>
                        <div class="scroll">
                            <div class="event-container">
                                <div>
                                    <div class="name-styling">
                                        NEW EVENT TITLE
                                    </div>
                                    <div class="sub-name-styling">
                                        Description
                                    </div>
                                </div>
                                <div>
                                    <div class="name-styling">
                                        DATE POSTED
                                    </div>
                                    <div class="sub-name-styling">
                                        Event Date
                                    </div>
                                    <div class="sub-name-styling">
                                        Location
                                    </div>
                                </div>
                            </div>
                            <div class="event-container">
                                <div>
                                    <div class="name-styling">
                                        NEW EVENT TITLE
                                    </div>
                                    <div class="sub-name-styling">
                                        Description
                                    </div>
                                </div>
                                <div>
                                    <div class="name-styling">
                                        DATE POSTED
                                    </div>
                                    <div class="sub-name-styling">
                                        Event Date
                                    </div>
                                    <div class="sub-name-styling">
                                        Location
                                    </div>
                                </div>
                            </div>
                            <div class="event-container">
                                <div>
                                    <div class="name-styling">
                                        NEW EVENT TITLE
                                    </div>
                                    <div class="sub-name-styling">
                                        Description
                                    </div>
                                </div>
                                <div>
                                    <div class="name-styling">
                                        DATE POSTED
                                    </div>
                                    <div class="sub-name-styling">
                                        Event Date
                                    </div>
                                    <div class="sub-name-styling">
                                        Location
                                    </div>
                                </div>
                            </div>
                            <div class="event-container">
                                <div>
                                    <div class="name-styling">
                                        NEW EVENT TITLE
                                    </div>
                                    <div class="sub-name-styling">
                                        Description
                                    </div>
                                </div>
                                <div>
                                    <div class="name-styling">
                                        DATE POSTED
                                    </div>
                                    <div class="sub-name-styling">
                                        Event Date
                                    </div>
                                    <div class="sub-name-styling">
                                        Location
                                    </div>
                                </div>
                            </div>
                            <div class="event-container">
                                <div>
                                    <div class="name-styling">
                                        NEW EVENT TITLE
                                    </div>
                                    <div class="sub-name-styling">
                                        Description
                                    </div>
                                </div>
                                <div>
                                    <div class="name-styling">
                                        DATE POSTED
                                    </div>
                                    <div class="sub-name-styling">
                                        Event Date
                                    </div>
                                    <div class="sub-name-styling">
                                        Location
                                    </div>
                                </div>
                            </div>
                            <div class="event-container">
                                <div>
                                    <div class="name-styling">
                                        NEW EVENT TITLE
                                    </div>
                                    <div class="sub-name-styling">
                                        Description
                                    </div>
                                </div>
                                <div>
                                    <div class="name-styling">
                                        DATE POSTED
                                    </div>
                                    <div class="sub-name-styling">
                                        Event Date
                                    </div>
                                    <div class="sub-name-styling">
                                        Location
                                    </div>
                                </div>
                            </div>
                            <div class="event-container">
                                <div>
                                    <div class="name-styling">
                                        NEW EVENT TITLE
                                    </div>
                                    <div class="sub-name-styling">
                                        Description
                                    </div>
                                </div>
                                <div>
                                    <div class="name-styling">
                                        DATE POSTED
                                    </div>
                                    <div class="sub-name-styling">
                                        Event Date
                                    </div>
                                    <div class="sub-name-styling">
                                        Location
                                    </div>
                                </div>
                            </div>
                            <div class="event-container">
                                <div>
                                    <div class="name-styling">
                                        NEW EVENT TITLE
                                    </div>
                                    <div class="sub-name-styling">
                                        Description
                                    </div>
                                </div>
                                <div>
                                    <div class="name-styling">
                                        DATE POSTED
                                    </div>
                                    <div class="sub-name-styling">
                                        Event Date
                                    </div>
                                    <div class="sub-name-styling">
                                        Location
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                </div>
            </div>
        </div>
    </body>
</html>


