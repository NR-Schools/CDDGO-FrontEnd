<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/InquiryModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';

class InquiryRepository
{
    static function createInquiry(Inquiry $inquiry): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO INQUIRIES
            VALUES (null, :studentId, null, :inquiryTitle, :inquiryDesc, :inquiryTime, FALSE, FALSE);
            ",
            [
                ":studentId" => $inquiry->Inquirer->StudID,
                ":inquiryTitle" => $inquiry->InquiryTitle,
                ":inquiryDesc" => $inquiry->InquiryDescription,
                ":inquiryTime" => $inquiry->InquiryTime
            ]
        );
    }

    static function getAllInquiries(): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM INQUIRIES
                INNER JOIN STUDENTS
                    ON INQUIRIES.RepliedInquiry = STUDENTS.StudID
            ",
            []
        );

        $inquiryList = array();
        foreach ($queryResult as $inquiryRecord) {

            $student = new Student();
            $student->StudID = $inquiryRecord['StudID'];
            $student->StudNo = $inquiryRecord['StudNo'];
            $student->FirstName = $inquiryRecord['FirstName'];
            $student->LastName = $inquiryRecord['LastName'];
            $student->Program = $inquiryRecord['Program'];
            $student->Email = $inquiryRecord['Email'];
            $student->Password = $inquiryRecord['Password'];
            $student->isVerified = $inquiryRecord['isVerified'];

            $inquiry = new Inquiry();
            $inquiry->InquiryID = $inquiryRecord['InquiryID'];
            $inquiry->Inquirer = $student;
            $inquiry->RepliedInquiry = $inquiryRecord['RepliedInquiry'];
            $inquiry->InquiryTitle = $inquiryRecord['InquiryTitle'];
            $inquiry->InquiryDescription = $inquiryRecord['InquiryDescription'];
            $inquiry->InquiryTime = $inquiryRecord['InquiryTime'];
            $inquiry->isInquirySeen = $inquiryRecord['isInquirySeen'];
            $inquiry->isFromAdmin = $inquiryRecord['isFromAdmin'];

            $inquiryList[] = $inquiry;
        }

        return $inquiryList;
    }

    static function replyToInquiry(int $inquiryReplyingTo, Inquiry $newInquiry, bool $isAdminReplying): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO INQUIRIES
            VALUES (null, :studentId, :inquiryReplyingTo, :inquiryTitle, :inquiryDesc, :inquiryTime, FALSE, :isFromAdmin)
            ",
            [
                ":studentId" => $newInquiry->Inquirer->StudID,
                ":inquiryReplyingTo" => $inquiryReplyingTo,
                ":inquiryTitle" => $newInquiry->InquiryTitle,
                ":inquiryDesc" => $newInquiry->InquiryDescription,
                ":inquiryTime" => $newInquiry->InquiryTime,
                ":isFromAdmin" => $isAdminReplying
            ]
        );
    }
}

?>