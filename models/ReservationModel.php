<?php

require_once("models/StudentModel.php");
require_once("models/BoardGameModel.php");

class Reservation {
    public int $ReservationID;
    public Student $ReservedStudent;
    public BoardGame $ReservedGame;
    public string $ReservedDate;
    public bool $isPaid;
    public int $ReservationFee;
}

?>