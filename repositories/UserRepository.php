<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/UserModel.php';


class UserRepository
{
    static function getUserByEmail($email): User|null
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM USERS
            WHERE Email = :email
            ",
            [ ":email" => $email ]
        );

        $user = null;
        foreach ($queryResult as $userResult) {
            $user = new User();
            $user->UserID = $userResult['UserID'];
            $user->Email = $userResult['Email'];
            $user->Password = $userResult['Password'];
            $user->Role = $userResult['Role'];
            break;
        }

        return $user;
    }

    static function createUser(User $user): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO USERS
            VALUES (null, :email, :password, :role);
            ",
            [
                ":email" => $user->Email,
                ":password" => $user->Password,
                ":role" => $user->Role
            ]
        );
    }

    static function updateUser(User $user): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            UPDATE USERS
            SET
                Email = :email,
                Password = :password
            WHERE
                UserID = :userId
            ",
            [
                ":userId" => $user->UserID,
                ":email" => $user->Email,
                ":password" =>$user->Password
            ]
        );
    }
}

?>