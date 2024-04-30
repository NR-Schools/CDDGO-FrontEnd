<?php

require_once("models/StudentModel.php");
require_once("models/BoardGameModel.php");

class Reservation {
    public int $ReservationID;
    public Student $student;
    public BoardGame $boardGame;
    public string $ReservedDate;
    public bool $isPaid;
    public int $ReservationFee;

    function __construct() {}
}

?>