<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/MemberModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/MemberRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";


class StudentService
{
    // This is for students
    static function getAllStudents(): array
    {
        return StudentRepository::getAllStudents();
    }

    static function getStudentById(int $studId)
    {
        return StudentRepository::getStudentById($studId);
    }

    // This is for members
    static function addMembers(int $studentId, Member $member): bool
    {
        return MemberRepository::createMember($studentId, $member);
    }

    static function getAllMembers(): array
    {
        return MemberRepository::getAllMembers();
    }

    static function removeMember(int $memberId)
    {
        return MemberRepository::deleteMember($memberId);
    }
}

?>