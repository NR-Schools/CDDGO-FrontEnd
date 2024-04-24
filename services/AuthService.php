<?php

// Build Paths From Root
require_once ("database/DatabaseConfig.php");
require_once ("models/StudentModel.php");
require_once ("services/StudentService.php");


function signup(Student $student): bool
{
    global $PDOConnection;

    // Check if email already exists
    $studentCheck = getStudentByEmail($student->Email);
    if ($studentCheck !== null)
        return false;

    // Create New Student
    $actionStatus = SQLwithoutFetch(
        $PDOConnection,
        "
        INSERT INTO STUDENTS
        VALUES (
            null,
            :studentNumber,
            :firstName,
            :lastName,
            :program,
            :email,
            :password,
            false
        );
        ",
        [
            ":studentNumber" => $student->StudNo,
            ":firstName" => $student->FirstName,
            ":lastName" => $student->LastName,
            ":program" => $student->Program,
            ":email" => $student->Email,
            ":password" => $student->Program
        ]
    );

    return $actionStatus;
}

function login(string $email, string $password): bool
{
    // Check if email already exists
    $studentCheck = getStudentByEmail($email);
    if ($studentCheck === null)
        return false;

    // Compare Passwords
    if ($studentCheck->Password !== $password)
        return false;

    return true;
}

?>