<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/models/MemberModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/MemberRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/StudentRepository.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/repositories/UserRepository.php";


class StudentService
{
    // This is for students
    static function getAllStudents(): array
    {
        return StudentRepository::getAllStudents();
    }

    static function getStudentById(int $studId): Student
    {
        return StudentRepository::getStudentById($studId);
    }

    static function getStudentByEmail(string $email): Student
    {
        return StudentRepository::getStudentByEmail($email);
    }

    static function updateStudent(Student $student): bool
    {
        $dbStudent = StudentRepository::getStudentById($student->StudID);
        UserRepository::updateUser($student);
        StudentRepository::updateStudent($student);

        // Call MemberRepository to update member assoc with student
        if ($dbStudent->member == null && $student->member != null) {
            // Add New Member Info
            MemberRepository::createMember($student->StudID, $student->member);
        }
        else if ($dbStudent->member != null && $student->member == null) {
            MemberRepository::deleteMember($student->StudID);
        }
        else if ($dbStudent->member != null && $student->member != null) {
            MemberRepository::updateMember($student->member);
        }

        return true;
    }

    static function confirmStudentRegistration(int $studentId): bool
    {
        $student = StudentRepository::getStudentById($studentId);
        $student->isVerified = true;
        return StudentRepository::updateStudent($student);
    }

    static function rejectStudentRegistration(int $studentId): bool
    {
        // Delete Student
        return StudentRepository::deleteStudent($studentId);
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