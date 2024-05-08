<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';


class BoardGameRepository
{

    private static function queryResultToBoardGame($queryResult, bool $includeRating): BoardGame
    {
        $boardGame = new BoardGame();
        $boardGame->GameID = $queryResult['GameID'];
        $boardGame->GameName = $queryResult['GameName'];
        $boardGame->GameImage = $queryResult['GameImage'];
        $boardGame->GameDescription = $queryResult['GameDescription'];
        $boardGame->QuantityAvailable = $queryResult['QuantityAvailable'];
        $boardGame->GameCategory = $queryResult['GameCategory'];
        $boardGame->GameStatus = $queryResult['GameStatus'];
        if ($includeRating) {
            $boardGame->GameRating = $queryResult['AverageRating'];
        }
        return $boardGame;
    }

    static function getAllBoardGames(): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM BOARD_GAMES;
            ",
            []
        );

        $boardGamesList = array();
        foreach ($queryResult as $boardGameQR) {
            $boardGamesList[] = self::queryResultToBoardGame($boardGameQR, false);
        }

        return $boardGamesList;
    }

    static function getCurrentlyRentedBoardGame(string $email): BoardGame|null
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM STUDENTS
                INNER JOIN RENTALS
                    ON STUDENTS.StudID = RENTALS.StudID
                INNER JOIN USERS
                    ON STUDENTS.StudID = USERS.UserID
                INNER JOIN BOARD_GAMES
                    ON RENTALS.GameID = BOARD_GAMES.GameID
                WHERE Email = :email;
            ",
            [":email" => $email]
        );

        $currentlyRentedBoardGame = null;
        foreach ($queryResult as $boardGameQR) {
            $currentlyRentedBoardGame = self::queryResultToBoardGame($boardGameQR, false);
            break;
        }

        return $currentlyRentedBoardGame;
    }

    static function getBoardGameById(int $boardGameId): BoardGame|null
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT bg.*, COALESCE(AVG(t.Rating), 0) AS AverageRating FROM BOARD_GAMES bg 
            LEFT JOIN TESTIMONIALS t ON bg.GameID = t.GameID 
            WHERE bg.GameID = :gameId 
            GROUP BY bg.GameName;
            ",
            [":gameId" => $boardGameId]
        );
        
        $resultBoardGame = null;
        foreach ($queryResult as $boardGameQR) {
            $resultBoardGame = self::queryResultToBoardGame($boardGameQR, true);
            break;
        }

        return $resultBoardGame;
    }

    static function getBoardGameByName(string $boardGameName): BoardGame|null
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM BOARD_GAMES
            WHERE GameName = :gameName
            ",
            [":gameName" => $boardGameName]
        );

        $resultBoardGame = null;
        foreach ($queryResult as $boardGameQR) {
            $resultBoardGame = self::queryResultToBoardGame($boardGameQR, false);
            break;
        }

        return $resultBoardGame;
    }

    static function addNewBoardGame(BoardGame $boardGame): bool
    {
        // Create Board Game
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO BOARD_GAMES
            VALUES (null, :gameName, :gameImage, :gameDesc, :quantityAvailable, :gameCategory, :gameStatus)
            ",
            [
                ":gameName" => $boardGame->GameName,
                ":gameImage" => $boardGame->GameImage,
                ":gameDesc" => $boardGame->GameDescription,
                ":quantityAvailable" => $boardGame->QuantityAvailable,
                ":gameCategory" => $boardGame->GameCategory,
                ":gameStatus" => $boardGame->GameStatus
            ]
        );
    }

    static function updateBoardGame(BoardGame $boardGame): bool
    {
        // Update Board Game
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            UPDATE BOARD_GAMES
            SET
                GameName = :gameName,
                GameImage = :gameImage,
                GameDescription = :gameDesc,
                QuantityAvailable = :quantityAvailable,
                GameCategory = :gameCategory,
                GameStatus = :gameStatus
            WHERE
                GameID = :gameId
            ",
            [
                ":gameId" => $boardGame->GameID,
                ":gameImage" => $boardGame->GameImage,
                ":gameName" => $boardGame->GameName,
                ":gameDesc" => $boardGame->GameDescription,
                ":quantityAvailable" => $boardGame->QuantityAvailable,
                ":gameCategory" => $boardGame->GameCategory,
                ":gameStatus" => $boardGame->GameStatus
            ]
        );
    }

    static function deleteBoardGame(int $boardGameId): bool
    {
        // Delete Board Game
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM BOARD_GAMES WHERE GameID = :gameId
            ",
            [ ":gameId" => $boardGameId ]
        );
    }
}

?>