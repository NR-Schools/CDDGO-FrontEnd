<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/TestimonialModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/TestimonialRepository.php";


class TestimonialService
{
    static function addMemberTestimonial(Testimonial $testimonial): bool
    {
        // Check if student is member
        // Add testimonial
    }

    static function getAllTestimonials(): array
    {
    }
}


?>