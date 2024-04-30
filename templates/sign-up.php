<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sign-up.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>

    <div class="main-container">
        <div class="sign-up-container">
            <div class="sign-up-title">
                SIGN-UP ACCOUNT
            </div>
            <div class="personal-details">
                <div class="form-title">Personal Details</div>
                <div class="divider"></div>
                <div class="content-container">
                    <div>
                        <label class="label-styling" for="">First Name</label>
                        <input class="input-styling" type="text">
                    </div>
                    <div>
                        <label class="label-styling" for="">Last Name</label>
                        <input class="input-styling" type="text">
                    </div>
                    <div>
                        <label class="label-styling" for="">Email</label>
                        <input class="input-styling" type="text">
                    </div>
                </div>
            </div>

            <div class="school-details">
                <div class="form-title">School Details</div>
                <div class="divider"></div>
                <div class="content-container">
                    <div>
                        <label class="label-styling" for="">First Name</label>
                        <input class="input-styling" type="text">
                    </div>
                    <div>
                        <label class="label-styling"f or="">Last Name</label>
                        <input class="input-styling" type="text">
                    </div>
                </div>
            </div>

            <div class="account-details">
                <div class="form-title">Account Details</div>
                <div class="divider"></div>
                <div class="content-container">
                    <div>
                        <label class="label-styling" for="">Student Number</label>
                        <input class="input-styling" type="text">
                    </div>
                    <div>
                        <label class="label-styling" for="">Program</label>
                        <input class="input-styling" type="text">
                    </div>
                </div>
            </div>
            <div class="button-container">
                <button class="button-styling">SIGN-UP</button>
            </div>
        </div>
    </div>
</body>
</html>