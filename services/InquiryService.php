<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/InquiryModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/InquiryRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";


class InquiryService
{
    static function getInquiryResponses(int $inquiryId): array
    {
        return InquiryRepository::getAllInquiryResponses($inquiryId);
    }


    // For students
    static function createStudentInquiry(string $email, Inquiry $inquiry): bool
    {
        // Get Student from email
        $student = StudentRepository::getStudentByEmail($email);

        return InquiryRepository::createInquiry($student->StudID, $inquiry);
    }

    static function getInquiriesByStudent(string $email): array
    {
        // Get Student from email
        $student = StudentRepository::getStudentByEmail($email);

        // Get Student Id
        return InquiryRepository::getInquiriesByStudent($student->StudID);
    }

    static function userReplyToInquiry(InquiryResponse $inquiryResponse): bool
    {
        // Get Student from email
        $inquiryResponse->ResponseSource = "USER";
        return InquiryRepository::createResponseToInquiry($inquiryResponse);
    }

    // For admin
    static function getAllInquiries(): array
    {
        return InquiryRepository::getAllInquiries();
    }
    
    static function adminReplyToInquiry(InquiryResponse $inquiryResponse): bool
    {
        $inquiryResponse->ResponseSource = "ADMIN";
        return InquiryRepository::createResponseToInquiry($inquiryResponse);
    }
}


?>