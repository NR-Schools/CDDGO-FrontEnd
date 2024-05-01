<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin-homepage.css">
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
        <div class="menu-container">
            <div class="admin-title">ADMIN MENU</div>
            <div class="divider"></div>
            <div>
                <button class="button-styling">MANAGE BOARD GAMES</button>
            </div>
            <div>
                <button class="button-styling">MANAGE EVENTS</button>
            </div>
            <div>
                <button class="button-styling">MANAGE BORROW RECORDS</button>
            </div>
            <div>
                <button class="button-styling">MANAGE USERS AND MEMBERS</button>
            </div>
            <div class="divider"></div>
        </div>
    </div>

    
</body>
</html>