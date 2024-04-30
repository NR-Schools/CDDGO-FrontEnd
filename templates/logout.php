<?php

// Perform user logout
require_once $_SERVER['DOCUMENT_ROOT'] . '/services/AuthService.php';

AuthService::logout();

header('Location: /');


?>