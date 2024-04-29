<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';

class Rental
{
    public int $RentalID;
    public Student $student;
    public BoardGame $boardGame;
    public string $BorrowDate;
    public int $Rent;

    function __construct() {}
}

?>