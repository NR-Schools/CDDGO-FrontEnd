<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/ReservationModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';


class ReservationRepository
{
    private static function queryResultsToReservation(array $queryResult): Reservation
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

        $reservation = new Reservation();
        $reservation->ReservationID = $queryResult['ReservationID'];
        $reservation->student = $student;
        $reservation->boardGame = $boardGame;
        $reservation->ReservedDate = $queryResult['ReservedDate'];
        $reservation->ReservationFee = $queryResult['ReservationFee'];
        $reservation->isPaid = $queryResult['isPaid'];

        return $reservation;
    }

    static function addNewReservation(Reservation $reservation): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO RESERVATIONS
            VALUES (null, :studId, :gameId, :reserveDate, FALSE, :reservationFee);
            ",
            [
                ":studId" => $reservation->student->StudID,
                ":gameId" => $reservation->boardGame->GameID,
                ":reserveDate" => $reservation->ReservedDate,
                ":reservationFee" => $reservation->ReservationFee
            ]
        );
    }

    static function getAllReservations(bool $isConfirmed): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM RESERVATIONS
                INNER JOIN STUDENTS
                    ON RESERVATIONS.ReservedStudent = STUDENTS.StudID
                INNER JOIN BOARD_GAMES
                    ON RESERVATIONS.ReservedGame = BOARD_GAMES.GameID
                WHERE RESERVATIONS.isPaid = :isConfirmed;
            ",
            [
                ":isConfirmed" => $isConfirmed
            ]
        );

        $reservations = [];
        foreach ($queryResult as $reservationEntry) {

            $reservations[] = self::queryResultsToReservation($reservationEntry);
        }

        return $reservations;
    }

    static function getReservationById(int $reservationId): Reservation
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM RESERVATIONS
                INNER JOIN STUDENTS
                    ON RESERVATIONS.ReservedStudent = STUDENTS.StudID
                INNER JOIN BOARD_GAMES
                    ON RESERVATIONS.ReservedGame = BOARD_GAMES.GameID
                WHERE ReservationID = :reserveId;
            ",
            [
                ":reserveId" => $reservationId
            ]
        );

        $reservation = null;
        foreach ($queryResult as $reservationEntry) {
            $reservation = self::queryResultsToReservation($reservationEntry);
            break;
        }

        return $reservation;
    }

    static function updateReservation(Reservation $reservation): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            UPDATE RESERVATIONS
            SET
                ReservedStudent = :reservedStudId,
                ReservedGame = :reservedGameId,
                ReservedDate = :reservedDate,
                isPaid = :isPaid,
                ReservationFee = :reservationFee
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
            [":reservationId" => $reservationId]
        );
    }

    static function deleteReservationByGameExceptStudent(int $boardGameId, int $studentId): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM RESERVATIONS
            WHERE ReservedGame = :gameId
                AND ReservedStudent != :studId;
            ",
            [
                ":gameId" => $boardGameId,
                ":studId" => $studentId
            ]
        );
    }


    static function isReservationAttemptValid(int $studId, int $gameId, string $date)
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT ReservedStudent, ReservedGame, ReservedDate
                FROM reservations
            WHERE ReservedStudent = :studId
                AND ReservedGame = :gameId
                AND ReservedDate = :reserveDate
            ",
            [
                ":studId" => $studId,
                ":gameId" => $gameId,
                ":reserveDate" => $date
            ]
        );


        return empty($queryResult);
    }
}

?>