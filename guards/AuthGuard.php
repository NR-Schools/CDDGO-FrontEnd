<?php

// Regenerate Session ID to protect against Session ID interception ;
//session_regenerate_id();

// HTTP Strict Transport Security (HSTS) protect against Man-in-the-middle attacks ;
// header('Strict-Transport-Security: max-age=31536000; includeSubDomains');


enum Role: string
{
    case USER = "USER";
    case ADMIN = "ADMIN";
}

class AuthGuard
{
    static function set_session(string $email, Role $role): void
    {
        // Set session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role->value;
    }

    static function get_session(): array
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $email = null;
        if (isset($_SESSION['email']))
            $email = $_SESSION['email'];

        return [$email, AuthGuard::get_session_role()];
    }

    static function clear_session(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = array();

        session_destroy();
    }

    static function get_session_role(): Role|null
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $session_email = !isset($_SESSION['email']);
        $session_role = !isset($_SESSION['role']);

        $no_auth = $session_email || $session_role;

        if ($no_auth) {
            // This is a Public User (No Accounts Signed In)
            return null;
        }

        // Get Role (USER or ADMIN)
        $assumed_role = $_SESSION['role'];

        return Role::tryFrom($assumed_role);
    }

    static function guard_route(Role $expected_role): bool
    {
        // Get Current Role
        $session_role = AuthGuard::get_session_role();

        if ($session_role === $expected_role)
            return true;
        return false;
    }
}

?>