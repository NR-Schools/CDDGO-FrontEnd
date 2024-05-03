<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/StudentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/BoardGameRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";


class BoardGameService
{

    static function addNewBoardGame(BoardGame $boardGame): bool
    {

        // Check if board game is unique
        $boardGameCheck = BoardGameRepository::getBoardGameByName($boardGame->GameName);
        if ($boardGameCheck !== null)
            return false;

        // Create board game
        return BoardGameRepository::addNewBoardGame($boardGame);
    }

    static function getBoardGameRating(int $boardGameId): float
    {
        // summarize user rating from testimonials
    }

    static function getAllBoardGames(): array
    {
        return BoardGameRepository::getAllBoardGames();
    }

    static function getCurrentlyRentedBoardGame($email): BoardGame|null
    {
        // Check if student with email exists
        $studentCheck = StudentRepository::getStudentByEmail($email);
        if ($studentCheck === null)
            return null;

        // Get currently rented
        return BoardGameRepository::getCurrentlyRentedBoardGame($email);
    }

    static function getBoardGameById(int $boardGameId): BoardGame|null
    {
        return BoardGameRepository::getBoardGameById($boardGameId);
    }

    static function updateExistingBoardGame(BoardGame $boardGame): bool
    {
        return BoardGameRepository::updateBoardGame($boardGame);
    }

    static function deleteExistingBoardGame(int $boardGameId): bool
    {
        return BoardGameRepository::deleteBoardGame($boardGameId);
    }
}


?>