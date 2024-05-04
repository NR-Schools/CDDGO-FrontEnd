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
    public bool $RentConfirm;

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