<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";


class BoardGameRepository
{
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
        foreach ($queryResult as $boardGame) {
            $resultboardGame = new BoardGame();

            $resultboardGame->GameID = $boardGame['GameID'];
            $resultboardGame->GameName = $boardGame['GameName'];
            $resultboardGame->GameImage = $boardGame['GameImage'];
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
        $result = Database::SQLwithFetch(
            Database::getPDO(),
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
            $currentlyRentedBoardGame->GameImage = $boardGame['GameImage'];
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
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
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
            $resultBoardGame->GameImage = $boardGame['GameImage'];
            $resultBoardGame->GameDescription = $boardGame['GameDescription'];
            $resultBoardGame->QuantityAvailable = $boardGame['QuantityAvailable'];
            $resultBoardGame->GameCategory = $boardGame['GameCategory'];
            $resultBoardGame->GameStatus = $boardGame['GameStatus'];
            break;
        }

        return $resultBoardGame;
    }

    static function getBoardGameByName(string $boardGameName): BoardGame|null
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM BOARD_GAMES WHERE GameName = :gameName
            ",
            [":gameName" => $boardGameName]
        );

        $resultBoardGame = null;
        foreach ($queryResult as $boardGame) {
            $resultBoardGame = new BoardGame();
            $resultBoardGame->GameID = $boardGame['GameID'];
            $resultBoardGame->GameName = $boardGame['GameName'];
            $resultBoardGame->GameImage = $boardGame['GameImage'];
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
        // Create Board Game
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO BOARD_GAMES
            VALUES (null, :gameName, :gameImage :gameDesc, :quantityAvailable, :gameCategory, :gameStatus)
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
                GameName = :gameName
                AND GameImage = :gameImage
                AND GameDescription = :gameDesc
                AND QuantityAvailable = :quantityAvailable
                AND GameCategory = :gameCategory
                AND GameStatus = :gameStatus
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