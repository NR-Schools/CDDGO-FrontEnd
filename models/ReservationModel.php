<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";

class Reservation {
    public int $ReservationID;
    public Student $student;
    public BoardGame $boardGame;
    public string $ReservedDate;
    public bool $isPaid; // will be also used as "confirmation"
    public int $ReservationFee;

    function __construct() {}

    function createOnlyStudentId(int $studentId): void
    {
        $student = new Student();
        $student->StudID = $studentId;
        $this->student = $student;
    }

    function createOnlyBoardGameId(int $boardGameId): void
    {
        $boardGame = new BoardGame();
        $boardGame->GameID = $boardGameId;
        $this->boardGame = $boardGame;
    }
}

?>