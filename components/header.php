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
                        echo <<<HEADER_CUSTOM_STYLE
                            <script src="../js/notification.js"></script>
                        HEADER_CUSTOM_STYLE;
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
                        <div class="dropdown">
                        <div class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-bell mx-2" viewBox="0 0 16 16">
                                <path
                                    d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                            </svg>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="notification-container">
                        </ul>
                        </div>
                        EOD;
                        break;
                    case Role::ADMIN:
                        echo <<<HEADER_CUSTOM_STYLE
                            <script src="../js/notification.js"></script>
                        HEADER_CUSTOM_STYLE;
                        // This is for Admin Header
                        echo <<<EOD
                        <div>
                            <img src="../assets/mtg-logo.jpg" alt="mdo" width="40" height="40" class="rounded-circle">
                        </div>
            
                        <div class="nav">
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