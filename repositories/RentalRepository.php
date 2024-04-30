<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/RentalModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';


class RentalRepository
{
    static function addNewRental(Rental $rental): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO RENTALS
            VALUES (null, :studId, :gameId, :borrowDate, :rent);
            ",
            [
                ":studId" => $rental->student->StudID,
                ":gameId" => $rental->boardGame->GameID,
                ":borrowDate" => $rental->BorrowDate,
                ":rent" => $rental->Rent
            ]
        );
    }

    static function getAllRentals(): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM RENTALS
                INNER JOIN STUDENTS
                    ON RENTALS.StudID = STUDENTS.StudID
                INNER JOIN BOARD_GAMES
                    ON RENTALS.GameID = BOARD_GAMES.GameID;
            ",
            []
        );

        $rentals = [];
        foreach ($queryResult as $rentalEntry) {

            $student = new Student();
            $student->StudID = $rentalEntry['StudID'];
            $student->StudNo = $rentalEntry['StudNo'];
            $student->FirstName = $rentalEntry['FirstName'];
            $student->LastName = $rentalEntry['LastName'];
            $student->Program = $rentalEntry['Program'];
            $student->Email = $rentalEntry['Email'];
            $student->Password = $rentalEntry['Password'];
            $student->isVerified = $rentalEntry['isVerified'];

            $boardGame = new BoardGame();
            $boardGame->GameID = $rentalEntry['GameID'];
            $boardGame->GameName = $rentalEntry['GameName'];
            $boardGame->GameImage = $rentalEntry['GameImage'];
            $boardGame->GameDescription = $rentalEntry['GameDescription'];
            $boardGame->QuantityAvailable = $rentalEntry['QuantityAvailable'];
            $boardGame->GameCategory = $rentalEntry['GameCategory'];
            $boardGame->GameStatus = $rentalEntry['GameStatus'];

            $rental = new Rental();
            $rental->RentalID = $rentalEntry['RentalID'];
            $rental->student = $student;
            $rental->boardGame = $boardGame;
            $rental->BorrowDate = $rentalEntry['BorrowDate'];
            $rental->Rent = $rentalEntry['Rent'];

            $rentals[] = $rental;
        }

        return $rentals;
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
}

?>