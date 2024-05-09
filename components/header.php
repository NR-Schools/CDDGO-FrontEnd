<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

echo <<<HEADER_STYLE_BOOTSTRAP
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
HEADER_STYLE_BOOTSTRAP;

?>


<header class="p-2 border-bottom" style="background-color:#9e0671;width:100%">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">

            <?php
            $role = AuthGuard::get_session_role();
            if ($role == null) {
                echo <<<EOD
                    <div class="col-md-3 mb-2 mb-md-0">
                        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                            <img src="../assets/mtg-logo.jpg" alt="mdo" width="40" height="40" class="rounded-circle">
                        </a>
                    </div>

                    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                        <li><a style="color:white;font-weight:bold;"href="../templates/sign-in.php" class="nav-link px-2">LOGIN</a></li>
                        <li><a style="color:white;font-weight:bold;" href="../templates/sign-up.php" class="nav-link px-2">REGISTER</a></li>
                        <li><a style="color:white;font-weight:bold;"href="../templates/about-us.php" class="nav-link px-2">ABOUT</a></li>
                    </ul>

                    <div class="col-md-3 text-end">
                    </div>
                EOD;
            } else {
                switch ($role) {
                    case Role::USER:
                        echo <<<HEADER_CUSTOM_SCRIPT
                            <script src="../js/notification.js"></script>
                        HEADER_CUSTOM_SCRIPT;
                        // This is for User Header
                        echo <<<EOD
                        <div class="col-md-3 mb-2 mb-md-0">
                            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                                <img src="../assets/mtg-logo.jpg" alt="mdo" width="40" height="40" class="rounded-circle">
                            </a>
                        </div>
            
                        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                            <li><a style="color:white;font-weight:bold;" href="../templates/user-homepage.php" class="nav-link px-2">HOME</a></li>
                            <li><a style="color:white;font-weight:bold;" href="../templates/user-board_games.php" class="nav-link px-2">BOARD GAMES</a></li>
                            <li><a style="color:white;font-weight:bold;" href="../templates/user-events.php" class="nav-link px-2">EVENTS</a></li>
                            <li><a style="color:white;font-weight:bold;"href="../templates/user-inquiries.php" class="nav-link px-2">INQUIRIES</a></li>
                            <li><a style="color:white;font-weight:bold;"href="../templates/logout.php" class="nav-link px-2">LOGOUT</a></li>
                        </ul>
            
                        <a class="col-md-3 text-end">
    
                        <a href="../templates/user-manage_account.php">
                            <img style="width:36px;" src="../assets/gear.png" alt="">
                        </a>   
                        
                        <div class="dropdown" onclick="openNotification()">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="position:relative;background-color:transparent;border:none;"> 
                                <img style="width:36px;" src="../assets/bell.png" alt="">
                                <div style="width:13px;height:13px;background-color:red;border-radius:100%;position:absolute;top:10px;right:30px;opacity:0" id="notification-red-dot"></div>
                            </button>
                            <ul class="dropdown-menu" style="width:300px; padding: 10px; padding-bottom: 0px; background-color: #32064e;" aria-labelledby="dropdownMenuButton1" id="notification-container">
                            </ul>
                        </div>

                        EOD;
                        break;
                    case Role::ADMIN:
                        echo <<<HEADER_CUSTOM_SCRIPT
                            <script src="../js/notification.js"></script>
                        HEADER_CUSTOM_SCRIPT;
                        // This is for Admin Header
                        echo <<<EOD
                        <div>
                            <img src="../assets/mtg-logo.jpg" alt="mdo" width="40" height="40" class="rounded-circle">
                        </div>
            
                        <div class="nav">
                            <div class="dropdown" onclick=openNotification()>
                                <div class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="position:relative;background-color:transparent;border:none;"> 
                                    <img style="width:36px;" src="../assets/bell.png" alt="">
                                    <div style="width:13px;height:13px;background-color:red;border-radius:100%;position:absolute;top:10px;right:30px;opacity:0" id="notification-red-dot"></div>
                                </div>
                                <ul class="dropdown-menu" style="width:300px; padding: 10px; padding-bottom: 0px; background-color: #32064e;" aria-labelledby="dropdownMenuButton1" id="notification-container">
                            </ul>
                            </div>
                            <li><a style="color:white !important;font-weight:bold;" href="../templates/admin-homepage.php" class="nav-link px-2 link-body-emphasis">ADMIN MENU</a></li>
                            <li><a style="color:white !important;font-weight:bold;" href="../templates/logout.php" class="nav-link px-2 link-body-emphasis">LOGOUT</a></li>
                        </div>
                        EOD;
                        break;
                }
            }
            ?>

        </div>
    </div>
</header>