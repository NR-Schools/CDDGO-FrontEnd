<?php

// Build Paths From Root
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php";

class AuthService
{
    static function getCurrentlyLoggedIn(): array
    {
        return AuthGuard::get_session();
    }

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

    static function login(string $email, string $password): array
    {
        // Check if admin
        $role = Role::USER;
        if ($email === "admin@email.com" && $password === "Admin123_") {
            $role = Role::ADMIN;
        } 

        // Check if email already exists
        $studentCheck = StudentRepository::getStudentByEmail($email);
        if ($studentCheck === null)
            return [false, "Student Does Not Exist"];

        // Compare Passwords
        if (password_verify($password, $studentCheck->Password))
            return [false, "Incorrect Password"];


        // Set Session
        AuthGuard::set_session($email, $role);

        return [true, ""];
    }

    static function logout(): void {
        AuthGuard::clear_session();
    }
}

?>