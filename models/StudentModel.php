<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/models/UserModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/MemberModel.php';

class Student extends User
{
    public int $StudID;
    public string $StudNo;
    public string $FirstName;
    public string $LastName;
    public string $Program;
    public bool $isVerified;
    public Member|null $member;

    function __construct() {}

    function getFullName(): string {
        return $this->FirstName . " " . $this->LastName;
    }
}


?>