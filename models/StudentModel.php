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

    function createFullDetails(
        $StudID,
        $StudNo,
        $FirstName,
        $LastName,
        $Program,
        $Email,
        $Password,
        $isVerified
    ) {
        $this->StudID = $StudID;
        $this->StudNo = $StudNo;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Program = $Program;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->isVerified = $isVerified;
    }
}


?>