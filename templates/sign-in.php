<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sign-in.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <!-- Include Header and Footer-->
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>
    <div class="main-container">
        <div class="login-container">
            <div class="logo-container">
                <div>
                    <img class="image-styling" src="../assets/mtg-logo.jpg" alt="">
                </div>
                <div class="divider"></div>
                <div class="logo-title">
                    MAPÚA TABLE TOP <br> GAMERS
                </div>
                <div class="logo-description">
                    Learn and play with <br> Mapùa's tabletop gamers
                </div>
            </div>

            <div class="login-components">
                <div class="login-title">
                    LOGIN ACCOUNT
                </div>
                <div>
                    <label class="cred-username" for="">Username</label>
                    <input class="cred-input" type="text">
                </div>
                <div>
                    <label class="cred-password" for="">Password</label>
                    <input class="cred-input" type="text">
                </div>
                <div class="fPassword-Button">
                    <button class="fPassword-styling">Forgot Password?</button>
                </div>
                <div>
                    <button class="login-styling">LOGIN</button>
                </div>
                <div class="not-registered-button">
                    Not registered?
                </div>
                <div>
                    <button class="sign-up-button">Sign-up</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>