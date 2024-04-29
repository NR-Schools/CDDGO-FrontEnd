<?php

// Perform user logout
require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';
AuthGuard::clear_session();

header('Location: /');


?>