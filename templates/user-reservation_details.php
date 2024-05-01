<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
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
    <div class="main-container">
        <div class="reservation-container">
            <div class="title-styling">
                RESERVATION DETAILS
            </div>
            <div class="divider"></div>
            <div>
                <img class="game-image" src="../assets/img-placeholder.png" alt="">
            </div>
            <div class="name-styling">BOARD GAME NAME</div>
            <div class="price-styling">TOTAL PRICE</div>
            <div class="date-container">
                <div class="label-styling">
                    Select Date
                </div>
                <div>
                    <input class="date-input" type="date">
                </div>
            </div>
            <div class="divider"></div>
            <div class="button-container">
                <button class="reserve-game-button">RESERVE GAME</button>
                <button class="cancel-button">CANCEL</button>
            </div>
        </div>
    </div>
</body>
</html>