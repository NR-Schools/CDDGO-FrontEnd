<?php

require_once("models/StudentModel.php");
require_once("models/BoardGame.php");


class Testimonial {

    public Student $student;
    public BoardGame $boardGame;
    public string $Statement;
    public int $Rating;
}

?>