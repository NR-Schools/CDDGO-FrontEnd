<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/RentalModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';


class RentalRepository
{
    private static function queryResultToRental(array $queryResult): Rental
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

        $boardGame = new BoardGame();
        $boardGame->GameID = $queryResult['GameID'];
        $boardGame->GameName = $queryResult['GameName'];
        $boardGame->GameImage = $queryResult['GameImage'];
        $boardGame->GameDescription = $queryResult['GameDescription'];
        $boardGame->QuantityAvailable = $queryResult['QuantityAvailable'];
        $boardGame->GameCategory = $queryResult['GameCategory'];
        $boardGame->GameStatus = $queryResult['GameStatus'];

        $rental = new Rental();
        $rental->RentalID = $queryResult['RentalID'];
        $rental->student = $student;
        $rental->boardGame = $boardGame;
        $rental->BorrowDate = $queryResult['BorrowDate'];
        $rental->Rent = $queryResult['Rent'];
        $rental->RentConfirm = $queryResult['RentConfirm'];

        return $rental;
    }

    static function addNewRental(Rental $rental): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO RENTALS
            VALUES (null, :studId, :gameId, :borrowDate, :rent, FALSE);
            ",
            [
                ":studId" => $rental->student->StudID,
                ":gameId" => $rental->boardGame->GameID,
                ":borrowDate" => $rental->BorrowDate,
                ":rent" => $rental->Rent
            ]
        );
    }

    static function getAllRentals(bool $rentConfirm): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM RENTALS
                INNER JOIN STUDENTS
                    ON RENTALS.StudID = STUDENTS.StudID
                INNER JOIN BOARD_GAMES
                    ON RENTALS.GameID = BOARD_GAMES.GameID
                INNER JOIN USERS
                    ON STUDENTS.StudID = USERS.UserID
                WHERE RentConfirm = :rentConfirm;
            ",
            [":rentConfirm" => $rentConfirm]
        );

        $rentals = [];
        foreach ($queryResult as $rentalResult) {
            $rentals[] = self::queryResultToRental($rentalResult);
        }

        return $rentals;
    }

    static function getRentalById(int $rentId): Rental
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM RENTALS
                INNER JOIN STUDENTS
                    ON RENTALS.StudID = STUDENTS.StudID
                INNER JOIN BOARD_GAMES
                    ON RENTALS.GameID = BOARD_GAMES.GameID
                INNER JOIN USERS
                    ON STUDENTS.StudID = USERS.UserID
                WHERE RentalID = :rentalId;
            ",
            [":rentalId" => $rentId]
        );

        $rental = null;
        foreach ($queryResult as $rentalResult) {
            $rental = self::queryResultToRental($rentalResult);
            break;
        }

        return $rental;
    }

    static function getRentalByUser(int $studentId): Rental|null
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM RENTALS r
            INNER JOIN USERS
                    ON STUDENTS.StudID = USERS.UserID
            WHERE r.StudID = :studId
            AND r.RentConfirm = TRUE
            ",
            [":studId" => $studentId]
        );

        $rental = null;
        foreach ($queryResult as $rentalResult) {
            $rental = self::queryResultToRental($rentalResult);
            break;
        }

        return $rental;
    }

    static function confirmRental(Rental $rental): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            UPDATE RENTALS
            SET
                RentConfirm = TRUE
            WHERE
                RentalID = :rentalId;
            ",
            [
                ":rentalId" => $rental->RentalID
            ]
        );
    }

    static function deleteRentalById(int $rentalId): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM RENTALS WHERE RentalID = :rentalId
            ",
            [":rentalId" => $rentalId]
        );
    }

    static function deleteRentalByGameExceptStudent(int $boardGameId, int $studentId): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM RENTALS
            WHERE ReservedGame = :gameId
                AND ReservedStudent != :studId
                AND RentConfirm = FALSE;
            ",
            [
                ":gameId" => $boardGameId,
                ":studId" => $studentId
            ]
        );
    }

    static function isRentalAttemptValid(int $studId, int $gameId): string
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT 
                CASE 
                    WHEN EXISTS (
                        SELECT * 
                        FROM RENTALS 
                        WHERE StudID = :studId
                    ) THEN 'ALREADY_RENTED'
                    WHEN (
                        SELECT COUNT(*) 
                        FROM RESERVATIONS 
                        WHERE ReservedGame = :gameId
                        AND ReservedDate = CURDATE()
                        AND isPaid = TRUE
                    ) + (
                        SELECT COUNT(*) 
                        FROM RENTALS 
                        WHERE GameID = :gameId
                        AND RentConfirm = TRUE
                        AND BorrowDate = CURDATE()
                    ) >= (
                        SELECT QuantityAvailable 
                        FROM BOARD_GAMES 
                        WHERE GameID = :gameId
                    ) THEN 'MAX_RENTED_GAME'
                ELSE 'AVAILABLE'
            END AS RentalStatus;
            ",
            [
                ":studId" => $studId,
                ":gameId" => $gameId
            ]
        );

        $result = "";
        foreach ($queryResult as $rentalResult) {
            $result = $rentalResult['RentalStatus'];
        }

        return $result;
    }

    static function checkGameAvailability(int $gameId): bool
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT 
                IF(
                    (
                        (SELECT COUNT(*) FROM RESERVATIONS 
                        WHERE ReservedGame = :gameId
                        AND ReservedDate = CURDATE()
                        AND isPaid = TRUE)
                    +
                        (SELECT COUNT(*) FROM RENTALS 
                        WHERE GameID = :gameId
                        AND RentConfirm = TRUE
                        AND BorrowDate = CURDATE())
                    ) >= (
                        SELECT QuantityAvailable 
                        FROM BOARD_GAMES 
                        WHERE GameID = :gameId
                    ),
                    TRUE,
                    FALSE
                )
            AS Available;
            ",
            [":gameId" => $gameId]
        );

        $isAvailable = null;
        foreach ($queryResult as $rentalResult) {
            $isAvailable = $rentalResult['Available'];
        }

        return $isAvailable;
    }
}

?>