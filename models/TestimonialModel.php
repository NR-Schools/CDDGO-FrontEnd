<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";


class Testimonial {

    public Student $student;
    public BoardGame $boardGame;
    public string $Statement;
    public int $Rating;

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
    }}

?>