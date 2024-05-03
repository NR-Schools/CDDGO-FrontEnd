<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/InquiryModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';

class InquiryRepository
{
    static function createInquiry(Inquiry $inquiry): bool
    {
    }

    static function replyToInquiry(int $inquiryReplyingTo, Inquiry $newInquiry, bool $isAdminReplying): bool
    {
    }
}

?>