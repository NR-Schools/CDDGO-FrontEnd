<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/InquiryModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/InquiryRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";


class InquiryService
{
    static function createInquiry(Inquiry $inquiry): bool
    {
        return InquiryRepository::createInquiry($inquiry);
    }

    static function getAllInquiries(): array
    {
        return InquiryRepository::getAllInquiries();
    }

    static function userReplyToInquiry(int $inquiryReplyingTo, Inquiry $newInquiry): bool
    {
        return InquiryRepository::replyToInquiry($inquiryReplyingTo, $newInquiry, false);
    }

    static function adminReplyToInquiry(int $inquiryReplyingTo, Inquiry $newInquiry): bool
    {
        return InquiryRepository::replyToInquiry($inquiryReplyingTo, $newInquiry, true);
    }
}


?>