<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_borrow_records.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        .banner {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between; /* To push the elements to the sides */
            align-items: center; /* To vertically center the content */
        }

        .banner-content {
            flex: 1; /* Takes up remaining space */
            padding: 20px; /* Adjust as needed */
        }

        .banner-image {
            flex: 1; /* Takes up remaining space */
        }

        .banner-image img {
            max-width: 100%; /* Ensures image doesn't exceed container width */
        }

        .banner-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff; /* Adjust as needed */
            color: #ffffff; /* Adjust as needed */
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        
    </style>
</head>
<body>
    <!-- Include Header -->
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!--Banner Start -->
    <div class="banner">
        <div class="banner-content">
            <h1>LEARN.</h1>
            <h2>PLAY.</h2>
            <h3>REPEAT.</h3>
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

    </div>
</body>
</html>