<?php

require_once("models/StudentModel.php");

class Inquiry {
    public int $InquiryID;
    public Student $Inquirer;
    public int $RepliedInquiryID;
    public string $InquiryTitle;
    public string $InquiryDescription;
    public bool $isInquirySeen;
    public bool $isFromAdmin;

    function __construct() {}
}

?>