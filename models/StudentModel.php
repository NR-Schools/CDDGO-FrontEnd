<?php

class Student
{
    public int $StudID;
    public string $StudNo;
    public string $FirstName;
    public string $LastName;
    public string $Program;
    public string $Email;
    public string $Password;
    public bool $isVerified;

    function __construct() {}

    function getFullName(): string {
        return $this->FirstName . " " . $this->LastName;
    }
}


?>