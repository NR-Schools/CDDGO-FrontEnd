<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

echo <<<HEADER_STYLE_BOOTSTRAP
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
HEADER_STYLE_BOOTSTRAP;

echo <<<HEADER_CUSTOM_STYLE
    <script src="../js/notification.js"></script>
HEADER_CUSTOM_STYLE;

?>


<header class="p-2 border-bottom" style="background-color:#9e0671;">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between">

            <?php
            $role = AuthGuard::get_session_role();
            if ($role == null) {
                echo <<<EOD
                    <div class="col-md-3 mb-2 mb-md-0">
                        <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                            <img src="https://github.com/mdo.png" alt="mdo" width="40" height="40" class="rounded-circle">
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
                        // This is for User Header
                        echo <<<EOD
                        <div class="col-md-3 mb-2 mb-md-0">
                            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                                <img src="https://github.com/mdo.png" alt="mdo" width="40" height="40" class="rounded-circle">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-gear mx-2" viewBox="0 0 16 16">
                                <path
                                    d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0" />
                                <path
                                    d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z" />
                            </svg>
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
                        // This is for Admin Header
                        echo <<<EOD
                        <div>
                            <img src="https://github.com/mdo.png" alt="mdo" width="40" height="40" class="rounded-circle">
                        </div>
            
                        <div class="nav">
                            <li><a href="../templates/admin-homepage.php" class="nav-link px-2 link-body-emphasis">ADMIN MENU</a></li>
                            <li><a href="../templates/logout.php" class="nav-link px-2 link-body-emphasis">LOGOUT</a></li>
                        </div>
                        EOD;
                        break;
                }
            }
            ?>

        </div>
    </div>
</header>