<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";


class Inquiry {
    public int $InquiryID;
    public Student $student;
    public string $InquiryTitle;
    public string $InquiryDesc;
    public string $InquiryCreatedAt;

    function __construct() {}
}


class InquiryResponse {
    public int $InquiryResponseID;
    public int $RefInquiryID;
    public string $ResponseText;
    public string $ResponseCreatedAt;
    public string $ResponseSource; // USER OR ADMIN
    function __construct() {}
}


?>