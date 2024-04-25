<?php

require_once ("database/DatabaseConfig.php");
require_once ("models/BoardGameModel.php");


class BoardGameRepository
{
    static function getAllBoardGames(): array
    {
        global $PDOConnection;

        $queryResult = SQLwithFetch(
            $PDOConnection,
            "
        SELECT * FROM BOARD_GAMES;
        ",
            []
        );

        $boardGamesList = array();
        foreach ($queryResult as $boardGame) {
            $resultboardGame = new BoardGame();

            $resultboardGame->GameID = $boardGame['GameID'];
            $resultboardGame->GameName = $boardGame['GameName'];
            $resultboardGame->GameDescription = $boardGame['GameDescription'];
            $resultboardGame->QuantityAvailable = $boardGame['QuantityAvailable'];
            $resultboardGame->GameCategory = $boardGame['GameCategory'];
            $resultboardGame->GameStatus = $boardGame['GameStatus'];

            $boardGamesList[] = $resultboardGame;
        }

        return $boardGamesList;
    }

    static function getCurrentlyRentedBoardGame(string $email): BoardGame|null
    {
        global $PDOConnection;

        $result = SQLwithFetch(
            $PDOConnection,
            "
        SELECT * FROM STUDENTS
            INNER JOIN RENTALS
                ON STUDENTS.StudID = RENTALS.StudID
            WHERE Email = :email;
        ",
            [":email" => $email]
        );

        $currentlyRentedBoardGame = null;
        foreach ($result as $boardGame) {
            $currentlyRentedBoardGame = new BoardGame();
            $currentlyRentedBoardGame->GameID = $boardGame['GameID'];
            $currentlyRentedBoardGame->GameName = $boardGame['GameName'];
            $currentlyRentedBoardGame->GameDescription = $boardGame['GameDescription'];
            $currentlyRentedBoardGame->QuantityAvailable = $boardGame['QuantityAvailable'];
            $currentlyRentedBoardGame->GameCategory = $boardGame['GameCategory'];
            $currentlyRentedBoardGame->GameStatus = $boardGame['GameStatus'];
            break;
        }

        return $currentlyRentedBoardGame;
    }

    static function getBoardGameById(int $boardGameId): BoardGame|null
    {
        global $PDOConnection;

        $queryResult = SQLwithFetch(
            $PDOConnection,
            "
        SELECT * FROM BOARD_GAMES WHERE GameID = :gameId
        ",
            [":gameId" => $boardGameId]
        );

        $resultBoardGame = null;
        foreach ($queryResult as $boardGame) {
            $resultBoardGame = new BoardGame();
            $resultBoardGame->GameID = $boardGame['GameID'];
            $resultBoardGame->GameName = $boardGame['GameName'];
            $resultBoardGame->GameDescription = $boardGame['GameDescription'];
            $resultBoardGame->QuantityAvailable = $boardGame['QuantityAvailable'];
            $resultBoardGame->GameCategory = $boardGame['GameCategory'];
            $resultBoardGame->GameStatus = $boardGame['GameStatus'];
            break;
        }

        return $resultBoardGame;
    }

    static function addNewBoardGame(BoardGame $boardGame): bool
    {
        global $PDOConnection;

        // Create Board Game
        return SQLwithoutFetch(
            $PDOConnection,
            "
        INSERT INTO BOARD_GAMES
        VALUES (null, :gameName, :gameDesc, :quantityAvailable, :gameCategory, :gameStatus)
        ",
            [
                ":gameName" => $boardGame->GameName,
                ":gameDesc" => $boardGame->GameDescription,
                ":quantityAvailable" => $boardGame->QuantityAvailable,
                ":gameCategory" => $boardGame->GameCategory,
                ":gameStatus" => $boardGame->GameStatus
            ]
        );
    }

    static function updateBoardGame(BoardGame $boardGame): bool
    {
        global $PDOConnection;

        // Create Board Game
        return SQLwithoutFetch(
            $PDOConnection,
            "
        UPDATE BOARD_GAMES
        SET
            GameName = :gameName
            AND GameDescription = :gameDesc
            AND QuantityAvailable = :quantityAvailable
            AND GameCategory = :gameCategory
            AND GameStatus = :gameStatus
        WHERE
            GameID = :gameId
        ",
            [
                ":gameId" => $boardGame->GameID,
                ":gameName" => $boardGame->GameName,
                ":gameDesc" => $boardGame->GameDescription,
                ":quantityAvailable" => $boardGame->QuantityAvailable,
                ":gameCategory" => $boardGame->GameCategory,
                ":gameStatus" => $boardGame->GameStatus
            ]
        );
    }
}

?>