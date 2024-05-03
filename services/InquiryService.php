<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/InquiryModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/InquiryRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";


class InquiryService
{

    // For students
    static function createStudentInquiry(Inquiry $inquiry): bool
    {
        return InquiryRepository::createInquiry($inquiry);
    }

    static function getInquiriesByStudent(int $studentId): array
    {
        //
    }

    static function userReplyToInquiry(int $inquiryReplyingTo, Inquiry $newInquiry): bool
    {
        return InquiryRepository::replyToInquiry($inquiryReplyingTo, $newInquiry, false);
    }

    // For admin
    static function getAllInquiries(): array
    {
        //
    }
    
    static function adminReplyToInquiry(int $inquiryReplyingTo, Inquiry $newInquiry): bool
    {
        return InquiryRepository::replyToInquiry($inquiryReplyingTo, $newInquiry, true);
    }
}


?>