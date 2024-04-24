<?php

require_once ("models/MemberModel.php");
require_once ("services/StudentService.php");

function setNewMember(string $email, Member $member): bool
{
    global $PDOConnection;

    $student = getStudentByEmail($email);

    return SQLwithoutFetch(
        $PDOConnection,
        "
        INSERT INTO MEMBERS VALUES (:studentId, :position, :yearJoined);
        ",
        [
            ":studentId" => $student->StudID,
            ":position" => $member->Position,
            ":yearJoined" => $member->YearJoined
        ]
    );
}

function getAllMembers(): array
{
    global $PDOConnection;

    $queryResult = SQLwithFetch(
        $PDOConnection,
        "
        SELECT * FROM MEMBERS
            INNER JOIN STUDENTS
                ON MEMBERS.MemberID = STUDENTS.StudID;
        ",
        []
    );

    $memberList = array();
    foreach ($queryResult as $memberRecord) {

        $student = new Student();
        $student->StudID = $memberRecord['StudID'];
        $student->StudNo = $memberRecord['StudNo'];
        $student->FirstName = $memberRecord['FirstName'];
        $student->LastName = $memberRecord['LastName'];
        $student->Program = $memberRecord['Program'];
        $student->Email = $memberRecord['Email'];
        $student->Password = $memberRecord['Password'];
        $student->isVerified = $memberRecord['isVerified'];

        $member = new Member();
        $member->student = $student;
        $member->Position = $memberRecord['Position'];
        $member->YearJoined = $memberRecord['YearJoined'];

        $memberList[] = $member;
    }

    return $memberList;
}

function updateMember(Member $member): bool
{
    global $PDOConnection;

    return SQLwithoutFetch(
        $PDOConnection,
        "
        UPDATE MEMBERS
        SET
            Position = :position
            AND YearJoined = :yearJoined
        WHERE MemberID = :studentId;
        ",
        [
            ":studentId" => $member->student->StudID,
            ":position" => $member->Position,
            ":yearJoined" => $member->YearJoined
        ]
    );
}

?>