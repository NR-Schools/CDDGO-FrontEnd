<?php

// Build Paths From Root
require_once ("database/DatabaseConfig.php");
require_once ("models/StudentModel.php");

function getStudentByEmail(string $email): Student|null
{
    global $PDOConnection;

    $students = SQLwithFetch(
        $PDOConnection,
        "
        SELECT * FROM STUDENTS WHERE Email = :email
        ",
        [":email" => $email]
    );

    $resultStudent = null;
    foreach($students as $student) {
        $resultStudent = new Student();
        $resultStudent->StudID = $student['StudID'];
        $resultStudent->StudNo = $student['StudNo'];
        $resultStudent->FirstName = $student['FirstName'];
        $resultStudent->LastName = $student['LastName'];
        $resultStudent->Program = $student['Program'];
        $resultStudent->Email = $student['Email'];
        $resultStudent->Password = $student['Password'];
        $resultStudent->isVerified = $student['isVerified'];
        break;
    }

    return $resultStudent;
}

?>