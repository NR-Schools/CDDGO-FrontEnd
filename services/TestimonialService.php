<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/TestimonialModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/TestimonialRepository.php";


class TestimonialService
{
    static function addMemberTestimonial(Testimonial $testimonial): bool
    {
        return TestimonialRepository::addNewTestimonial($testimonial);
    }

    static function getAllTestimonials(): array
    {
        return TestimonialRepository::getAllTestimonials();
    }

    // Add More Service Actions
}


?>