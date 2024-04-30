<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/ReservationModel.php';


class ReservationRepository
{
    static function addNewReservation(Reservation $reservation): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO RESERVATIONS
            VALUES (null, :studId, :gameId, :reserveDate, :isPaid, :reservationFee);
            ",
            [
                ":studId" => $reservation->student->StudID,
                ":gameId" => $reservation->boardGame->GameID,
                ":reserveDate" => $reservation->ReservedDate,
                ":isPaid" => $reservation->isPaid,
                ":reservationFee" => $reservation->ReservationFee
            ]
        );
    }

    static function getAllReservations(): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM RESERVATIONS
                INNER JOIN STUDENTS
                    ON RESERVATIONS.ReservedStudent = STUDENTS.StudID
                INNER JOIN BOARD_GAMES
                    ON RESERVATIONS.ReservedGame = BOARD_GAMES.GameID;
            ",
            []
        );

        $reservations = [];
        foreach ($queryResult as $reservationEntry) {

            $student = new Student();
            $student->StudID = $reservationEntry['StudID'];
            $student->StudNo = $reservationEntry['StudNo'];
            $student->FirstName = $reservationEntry['FirstName'];
            $student->LastName = $reservationEntry['LastName'];
            $student->Program = $reservationEntry['Program'];
            $student->Email = $reservationEntry['Email'];
            $student->Password = $reservationEntry['Password'];
            $student->isVerified = $reservationEntry['isVerified'];

            $boardGame = new BoardGame();
            $boardGame->GameID = $reservationEntry['GameID'];
            $boardGame->GameName = $reservationEntry['GameName'];
            $boardGame->GameImage = $reservationEntry['GameImage'];
            $boardGame->GameDescription = $reservationEntry['GameDescription'];
            $boardGame->QuantityAvailable = $reservationEntry['QuantityAvailable'];
            $boardGame->GameCategory = $reservationEntry['GameCategory'];
            $boardGame->GameStatus = $reservationEntry['GameStatus'];

            $reservation = new Reservation();
            $reservation->ReservationID = $reservationEntry['ReservationID'];
            $reservation->student = $student;
            $reservation->boardGame = $boardGame;
            $reservation->ReservedDate = $reservationEntry['ReservedDate'];
            $reservation->ReservationFee = $reservationEntry['ReservationFee'];
            $reservation->isPaid = $reservationEntry['isPaid'];

            $reservations[] = $reservation;
        }

        return $reservations;
    }

    static function updateReservation(Reservation $reservation): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            UPDATE RESERVATIONS
            SET
                ReservedStudent = :reservedStudId
                AND ReservedGame = :reservedGameId
                AND ReservedDate = :reservedDate
                AND isPaid = :isPaid
                AND ReservationFee = :reservationFee
            WHERE ReservationID = :reservationId;
            ",
            [
                ":reservationId" => $reservation->ReservationID,
                ":reservedStudId" => $reservation->student->StudID,
                ":reservedGameId" => $reservation->boardGame->GameID,
                ":reservedDate" => $reservation->ReservedDate,
                ":isPaid" => $reservation->isPaid,
                ":reservationFee" => $reservation->ReservationFee
            ]
        );
    }

    static function deleteReservation(int $reservationId): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM RESERVATIONS
            WHERE ReservationID = :reservationId;
            ",
            [ ":reservationId" => $reservationId ]
        );
    }
}

?>