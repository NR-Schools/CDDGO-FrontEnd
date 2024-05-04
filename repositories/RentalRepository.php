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
                WHERE RentConfirm = :rentConfirm;
            ",
            [ ":rentConfirm" => $rentConfirm ]
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
                WHERE RentalID = :rentalId;
            ",
            [ ":rentalId" => $rentId ]
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
            SELECT *
            FROM RENTALS r
            WHERE r.StudID = :studId
            AND r.RentConfirm = TRUE
            ",
            [ ":studId" => $studentId ]
        );

        $rental = null;
        foreach ($queryResult as $rentalResult) {
            $rental = self::queryResultToRental($rentalResult);
            break;
        }

        return $rental;
    }

    static function deleteRentalById(int $rentalId): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM RENTALS WHERE RentalID = :rentalId
            ",
            [ ":rentalId" => $rentalId ]
        );
    }

    static function deleteRentalByGameExceptStudent(int $boardGameId, int $studentId): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM RENTALS
            WHERE ReservedGame = :gameId
                AND ReservedStudent != :studId;
            ",
            [
                ":gameId" => $boardGameId,
                ":studId" => $studentId
            ]
        );
    }
}

?>