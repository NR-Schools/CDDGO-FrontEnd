<?php

// Set Environment Variables
$env = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/.env");
foreach ($env as $key => $value) {
    $_ENV[$key] = $value;
}

// Initialize Database
require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseInit.php";

?>