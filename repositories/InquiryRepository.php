<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/InquiryModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';

class InquiryRepository
{
    private static function queryResultToInquiry(array $queryResult): Inquiry
    {
        $student = new Student();
        $student->StudID = $queryResult['StudID'];
        $student->StudNo = $queryResult['StudNo'];
        $student->FirstName = $queryResult['FirstName'];
        $student->LastName = $queryResult['LastName'];
        $student->Program = $queryResult['Program'];
        $student->Email = $queryResult['Email'];
        $student->Password = $queryResult['Password'];
        $student->isVerified = $queryResult['isVerified'];

        $inquiry = new Inquiry();
        $inquiry->InquiryID = $queryResult['InquiryID'];
        $inquiry->InquiryTitle = $queryResult['InquiryTitle'];
        $inquiry->InquiryDesc = $queryResult['InquiryDesc'];
        $inquiry->InquiryCreatedAt = $queryResult['InquiryCreatedAt'];
        $inquiry->student = $student;

        return $inquiry;
    }

    private static function queryResultToInquiryResponse(array $queryResult): InquiryResponse
    {
        $inquiryResponse = new InquiryResponse();
        $inquiryResponse->InquiryResponseID = $queryResult['InquiryResponseID'];
        $inquiryResponse->RefInquiryID = $queryResult['RefInquiryID'];
        $inquiryResponse->ResponseText = $queryResult['ResponseText'];
        $inquiryResponse->ResponseSource = $queryResult['ResponseSource'];
        $inquiryResponse->ResponseCreatedAt = $queryResult['ResponseCreatedAt'];
        return $inquiryResponse;
    }

    static function getAllInquiries(): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM INQUIRIES
            INNER JOIN STUDENTS
            ON INQUIRIES.InquiryStudID = STUDENTS.StudID;
            ",
            []
        );

        $inquiryList = [];
        foreach($queryResult as $inquiryResult)
        {
            $inquiryList[] = self::queryResultToInquiry($inquiryResult);
        }

        return $inquiryList;
    }

    static function getInquiryById(int $inquiryId): Inquiry|null
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM INQUIRIES
            INNER JOIN STUDENTS
            ON INQUIRIES.InquiryStudID = STUDENTS.StudID
            WHERE InquiryID = :inquiryId;
            ",
            [
                ":inquiryId" => $inquiryId
            ]
        );

        $inquiry = null;
        foreach($queryResult as $inquiryResult)
        {
            $inquiry = self::queryResultToInquiry($inquiryResult);
            break;
        }

        return $inquiry;
    }

    static function getInquiriesByStudent(int $studentId): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM INQUIRIES
            INNER JOIN STUDENTS
            ON INQUIRIES.InquiryStudID = STUDENTS.StudID
            WHERE STUDENTS.StudID = :studentId
            ",
            [
                ":studentId" => $studentId
            ]
        );

        $inquiryList = [];
        foreach($queryResult as $inquiryResult)
        {
            $inquiryList[] = self::queryResultToInquiry($inquiryResult);
        }

        return $inquiryList;
    }

    static function getAllInquiryResponses(int $inquiryId): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT res.* FROM INQUIRIES inq
            INNER JOIN INQUIRY_RESPONSES res
            ON inq.InquiryID = res.RefInquiryID
            WHERE res.RefInquiryID = :inquiryId;
            ",
            [
                ":inquiryId" => $inquiryId
            ]
        );

        $inquiryResponseList = [];
        foreach($queryResult as $inquiryResponseResult)
        {
            $inquiryResponseList[] = self::queryResultToInquiryResponse($inquiryResponseResult);
        }

        return $inquiryResponseList;
    }

    static function createInquiry(Inquiry $inquiry): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO INQUIRIES VALUES (null, :studId, :inquiryTitle, :inquiryDesc, null);
            ",
            [
                ":studId" => $inquiry->student->StudID,
                ":inquiryTitle" => $inquiry->InquiryTitle,
                ":inquiryDesc" => $inquiry->InquiryDesc
            ]
        );
    }

    static function createResponseToInquiry(InquiryResponse $inquiryResponse): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO INQUIRY_RESPONSES VALUES (null, :refInqId, :responseText, null, :responseSource);
            ",
            [
                ":refInqId" => $inquiryResponse->RefInquiryID,
                ":responseText" => $inquiryResponse->ResponseText,
                ":responseSource" => $inquiryResponse->ResponseSource
            ]
        );
    }

    static function deleteInquiry(int $inquiryId): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM INQUIRIES WHERE InquiryID = :inquiryId;
            ",
            [ ":inquiryId" => $inquiryId ]
        );
    }
}

?>