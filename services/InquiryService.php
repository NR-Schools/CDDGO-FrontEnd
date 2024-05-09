<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/InquiryModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/InquiryRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/NotificationService.php";


class InquiryService
{
    static function getInquiryResponses(int $inquiryId): array
    {
        return InquiryRepository::getAllInquiryResponses($inquiryId);
    }

    static function getInquiryById(int $inquiryId): Inquiry|null
    {
        return InquiryRepository::getInquiryById($inquiryId);
    }

    // For students
    static function createStudentInquiry(Inquiry $inquiry): bool
    {
        // Add Student Inquiry
        InquiryRepository::createInquiry($inquiry);

        // Make Notification
        $notification = new Notification();
        $notification->NotificationTitle = "Student Inquiry";
        $notification->NotificationBody = "{$inquiry->student->getFullName()} has a new inquiry!";
        $notification->TargetEmail = "admin@email.com";
        NotificationService::addNewNotification($notification);
        return true;
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
        $inquiryResponse->ResponseSource = "USER";
        InquiryRepository::createResponseToInquiry($inquiryResponse);

        // Make Notification
        $inquiry = self::getInquiryById($inquiryResponse->RefInquiryID);
        $notification = new Notification();
        $notification->NotificationTitle = "Student Inquiry Reply";
        $notification->NotificationBody = "{$inquiry->student->getFullName()} replied!";
        $notification->TargetEmail = "admin@email.com";
        NotificationService::addNewNotification($notification);

        return true;
    }

    // For admin
    static function getAllInquiries(): array
    {
        return InquiryRepository::getAllInquiries();
    }

    static function adminReplyToInquiry(InquiryResponse $inquiryResponse): bool
    {
        $inquiryResponse->ResponseSource = "ADMIN";
        InquiryRepository::createResponseToInquiry($inquiryResponse);

        // Make Notification
        $inquiry = self::getInquiryById($inquiryResponse->RefInquiryID);
        $notification = new Notification();
        $notification->NotificationTitle = "Admin Inquiry Reply";
        $notification->NotificationBody = "MTG Admin replied!";
        $notification->TargetEmail = $inquiry->student->Email;
        NotificationService::addNewNotification($notification);

        return true;
    }

    static function adminRemoveInquiry(int $inquiryId): bool
    {
        return InquiryRepository::deleteInquiry($inquiryId);
    }
}


?>