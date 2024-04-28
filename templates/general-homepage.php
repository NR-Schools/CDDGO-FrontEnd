<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';
?>

<!--html codes-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_borrow_records.css">
    <link type="text/css" rel="stylesheet" href="../css/general-homepage.css">
</head>
<body>
    <!-- Include Header and Footer-->
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>

    <!--Banner Start -->
    <div class="banner">
        <div class="banner-content">
            <h1 style="font-size: 4rem; font-weight: bold;">LEARN.</h1> 
            <h2 style="font-size: 3.5rem; font-weight: bold;">PLAY.</h2>
            <h3 style="font-weight: bold;">REPEAT.</h3>
            <p>Tabletop board games have never been this fun!</p>
            <a href="sign-up.php" class="banner-button">JOIN</a>
        </div>
        <div class="banner-image">
            <img src="../assets/banner-pic.jpg" alt="Banner Image">
        </div>
    </div>
    <!--banner end-->

    <!--content start-->
    <div class="home-content">
        <div class="mtg-logo">
            <img src="../assets/mtg-logo.jpg" alt="MTG Logo">
        </div>
        <div class="divider"></div>
        <div class="mtg-bg">
            <p>Mapúa Tabletop Gamers (MTG) began as a student club with the goal of serving the recreational needs of its student body. MTG aims to provide a place where people can unwind and have fun away from the demanding academics of university life. Game nights, tournaments, and enlightening workshops are just a few of the planned events that MTG hosts to encourage social and community service among its members. MTG fosters a sense of community among the school population while providing a hub for students looking for a break from their academic obligations thanks to its wide selection of games and welcoming atmosphere.</p>
            <div class="mtg-learn-button">
                <a href="about-us.php" class="learn-button">Learn more</a>
            </div>
        </div>
    </div>
</body>
</html>

