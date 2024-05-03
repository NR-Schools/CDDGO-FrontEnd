<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/TestimonialModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/BoardGameModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/TestimonialRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";


class TestimonialService
{
    static function addMemberTestimonial(string $email, Testimonial $testimonial): bool
    {
        // Check if student is member
        $student = StudentRepository::getStudentByEmail($email);
        if ($student->member === null)
        {
            return false;
        }

        // Add testimonial
        return TestimonialRepository::addNewTestimonial($testimonial);
    }

    static function getAllTestimonials(): array
    {
        return TestimonialRepository::getAllTestimonials();
    }
}


?>