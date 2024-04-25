<?php

require_once ("database/DatabaseConfig.php");


class StudentRepository
{
    static function addNewStudent(Student $student): bool {
        global $PDOConnection;

        return SQLwithoutFetch(
            $PDOConnection,
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
        global $PDOConnection;

        $students = SQLwithFetch(
            $PDOConnection,
            "
        SELECT * FROM STUDENTS WHERE Email = :email
        ",
            [":email" => $email]
        );

        $resultStudent = null;
        foreach ($students as $student) {
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