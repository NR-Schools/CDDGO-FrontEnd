<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/database/DatabaseConfig.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/StudentModel.php';


class StudentRepository
{
    static function addNewStudent(Student $student): bool {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO STUDENTS
            VALUES (
                null,
                :studentNumber,
                :firstName,
                :lastName,
                :program,
                :email,
                :password,
                false
            );
            ",
            [
                ":studentNumber" => $student->StudNo,
                ":firstName" => $student->FirstName,
                ":lastName" => $student->LastName,
                ":program" => $student->Program,
                ":email" => $student->Email,
                ":password" => $student->Program
            ]
        );
    }

    static function getStudentByEmail(string $email): Student|null
    {
        $resultQuery = Database::SQLwithFetch(
            Database::getPDO(),
            "
        SELECT * FROM STUDENTS WHERE Email = :email
        ",
            [":email" => $email]
        );

        $resultStudent = null;
        foreach ($resultQuery as $student) {
            $resultStudent = new Student();
            $resultStudent->StudID = $student['StudID'];
            $resultStudent->StudNo = $student['StudNo'];
            $resultStudent->FirstName = $student['FirstName'];
            $resultStudent->LastName = $student['LastName'];
            $resultStudent->Program = $student['Program'];
            $resultStudent->Email = $student['Email'];
            $resultStudent->Password = $student['Password'];
            $resultStudent->isVerified = $student['isVerified'];
            break;
        }

        return $resultStudent;
    }

    static function getAllStudents(): array
    {
        $resultQuery = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM STUDENTS
            ",
            []
        );

        $studentList = [];
        foreach ($resultQuery as $student) {
            $resultStudent = new Student();
            $resultStudent->StudID = $student['StudID'];
            $resultStudent->StudNo = $student['StudNo'];
            $resultStudent->FirstName = $student['FirstName'];
            $resultStudent->LastName = $student['LastName'];
            $resultStudent->Program = $student['Program'];
            $resultStudent->Email = $student['Email'];
            $resultStudent->Password = $student['Password'];
            $resultStudent->isVerified = $student['isVerified'];

            $studentList[] = $resultStudent;
        }

        return $studentList;
    }

    static function getStudentById(int $studId): Student
    {
        $resultQuery = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM STUDENTS WHERE StudID = :studId
            ",
            [":studId" => $studId]
        );

        $resultStudent = null;
        foreach ($resultQuery as $student) {
            $resultStudent = new Student();
            $resultStudent->StudID = $student['StudID'];
            $resultStudent->StudNo = $student['StudNo'];
            $resultStudent->FirstName = $student['FirstName'];
            $resultStudent->LastName = $student['LastName'];
            $resultStudent->Program = $student['Program'];
            $resultStudent->Email = $student['Email'];
            $resultStudent->Password = $student['Password'];
            $resultStudent->isVerified = $student['isVerified'];
            break;
        }

        return $resultStudent;
    }
}

?>