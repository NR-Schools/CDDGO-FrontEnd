<?php

// Build Paths From Root
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";

class AuthService
{
    static function signup(Student $student): bool
    {
        // Check if email already exists
        $studentCheck = StudentRepository::getStudentByEmail($student->Email);
        if ($studentCheck !== null)
            return false;

        // Hash the student's password
        $student->Password = password_hash($student->Password, PASSWORD_BCRYPT);

        // Create New Student
        return StudentRepository::addNewStudent($student);
    }

    static function login(string $email, string $password): bool
    {
        // Check if email already exists
        $studentCheck = StudentRepository::getStudentByEmail($email);
        if ($studentCheck === null)
            return false;

        // Compare Passwords
        if (password_verify($password, $studentCheck->Password))
            return false;

        return true;
    }
}

?>