<?php

// Build Paths From Root
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/UserModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/UserRepository.php";
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
        $studentCheck = UserRepository::getUserByEmail($student->Email);
        if ($studentCheck !== null)
            return false;

        // Create New User
        $student->Role = "USER";
        UserRepository::createUser($student);

        // Get UserID
        $user = UserRepository::getUserByEmail($student->Email);
        $student->StudID = $user->UserID;

        // Create New Student
        return StudentRepository::addNewStudent($student);
    }

    static function login(string $email, string $password): array
    {
        // Check if email already exists
        $user = UserRepository::getUserByEmail($email);
        if ($user === null)
            return [false, "User Does Not Exist!!"];

        // Compare Passwords
        if ($password !== $user->Password)
            return [false, "Incorrect Password for User !!"];
        
        // Determine Role
        $role = Role::USER;
        if ($user->Role == "ADMIN")
        {
            $role = Role::ADMIN;
        }

        // Set Session
        AuthGuard::set_session($email, $role);

        return [true, ""];
    }

    static function logout(): void
    {
        AuthGuard::clear_session();
    }
}

?>