<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTG - Manage Users</title>
    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_users.css">
</head>

<body>
    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>

    <div class="reservations-title">
        <p>USER MANAGEMENT</p>
    </div>

    <!-- Start Body -->
    <div class="reservation-main-container">
        <div class="reservation-title">
            Edit/Delete Users
        </div>

        <div class="reservation-list-container">
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['delete'])) {
                    
                    $studentId = $_POST['studentId'];
                    // Confirm student registration
                    StudentService::deleteStudent($studentId);
                    echo "<script> alert('User Deleted');
                        </script>";
                }
            }
            // Get all students
            $students = StudentService::getAllStudents();

            foreach ($students as $student) {
                assert($student instanceof Student);

                // Check if the student is verified
                if ($student->isVerified) {
                    // Determine member status
                    $memberStatus = ($student->member !== null) ? "member" : "non-member";

                    $editLink = "/templates/admin-edit_members.php?studId=" . $student->StudID;

                    echo <<<EOD

                        <div class="reservation-entry">
                            <div>
                                <div>
                                    <span class="name-styling">STUDENT NO.</span>
                                    <span>{$student->StudNo}</span>
                                </div>
                                <div>
                                    <span class="name-styling">FULL NAME</span>
                                    <span>{$student->getFullName()}</span>
                                </div>
                                <div>
                                    <span class="name-styling">EMAIL</span>
                                    <span>{$student->Email}</span>
                                </div>
                                <div>
                                    <span class="name-styling">PROGRAM</span>
                                    <span>{$student->Program}</span>
                                </div>
                                <div>
                                    <span class="name-styling">MEMBERSHIP</span>
                                    <span>{$memberStatus}</span>
                                </div>  
                            </div>
                            <div>
                                <button type="button" class="btn btn-danger" onclick="window.location.href='{$editLink}'">Edit</button>
                                <form action="admin-manage_users.php" method="POST">
                                    <input type="hidden" name="studentId" value="{$student->StudID}">
                                    <button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>
                                </form>
                            </div>
                        </div>
                        EOD;
                }
            }
            ?>
        </div>


    </div>

    <!-- Include Footer -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php"; ?>

</body>

</html>