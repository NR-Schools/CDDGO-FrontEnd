<?php

// Build Paths From Root
require_once "models/StudentModel.php";
require_once "repositories/StudentRepository.php";

class AuthService
{
    static function signup(Student $student): bool
    {
        // Check if email already exists
        $studentCheck = StudentRepository::getStudentByEmail($student->Email);
        if ($studentCheck !== null)
            return false;

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
        if ($studentCheck->Password !== $password)
            return false;

        return true;
    }
}

?>