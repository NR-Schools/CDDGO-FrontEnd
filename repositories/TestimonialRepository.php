<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/TestimonialModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/models/BoardGameModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';


class TestimonialRepository
{
    static function addNewTestimonial(Testimonial $testimonial): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO TESTIMONIAL
            VALUES (:studId, :gameId, :statement, :rating);
            ",
            [
                ":studId" => $testimonial->student->StudID,
                ":gameId" => $testimonial->boardGame->GameID,
                ":statement" => $testimonial->Statement,
                ":rating" => $testimonial->Rating
            ]
        );
    }

    static function getAllTestimonials(): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM TESTIMONIALS
                INNER JOIN STUDENTS
                    ON TESTIMONIALS.StudID = STUDENTS.StudID
                INNER JOIN BOARD_GAMES
                    ON TESTIMONIALS.GameID = BOARD_GAMES.GameID;
            ",
            []
        );

        $testimonials = [];
        foreach ($queryResult as $testimonialEntry) {

            $student = new Student();
            $student->StudID = $testimonialEntry['StudID'];
            $student->StudNo = $testimonialEntry['StudNo'];
            $student->FirstName = $testimonialEntry['FirstName'];
            $student->LastName = $testimonialEntry['LastName'];
            $student->Program = $testimonialEntry['Program'];
            $student->Email = $testimonialEntry['Email'];
            $student->Password = $testimonialEntry['Password'];
            $student->isVerified = $testimonialEntry['isVerified'];

            $boardGame = new BoardGame();
            $boardGame->GameID = $testimonialEntry['GameID'];
            $boardGame->GameName = $testimonialEntry['GameName'];
            $boardGame->GameImage = $testimonialEntry['GameImage'];
            $boardGame->GameDescription = $testimonialEntry['GameDescription'];
            $boardGame->QuantityAvailable = $testimonialEntry['QuantityAvailable'];
            $boardGame->GameCategory = $testimonialEntry['GameCategory'];
            $boardGame->GameStatus = $testimonialEntry['GameStatus'];

            $testimonial = new Testimonial();
            $testimonial->student = $student;
            $testimonial->boardGame = $boardGame;
            $testimonial->Statement = $testimonialEntry['Statement'];
            $testimonial->Rating = $testimonialEntry['Rating'];

            $testimonials[] = $testimonial;
        }

        return $testimonials;
    }
}

?>