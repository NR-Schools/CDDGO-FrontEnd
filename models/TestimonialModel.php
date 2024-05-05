<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";


class Testimonial {

    public Student $student;
    public BoardGame $boardGame;
    public string $Statement;
    public int $Rating;

    function __construct() {}
}

?>