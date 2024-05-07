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
    <title>Manage Registrations</title>
    <!-- CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_registrations.css">
</head>
<body>
    <!-- Include Header -->
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Start Body -->
    <div class="main-body">
        <div class="event-title">
            MANAGE REGISTRATIONS
        </div>
        <div class="divider-container">
            <div class="divider"></div>
        </div>

        <div class="registrations-list-container">

            <?php
                // Check if the form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['confirm'])) {
                        
                        $studentId = $_POST['studentId'];
                        // Confirm student registration
                        StudentService::confirmStudentRegistration($studentId);
                        header("Location: admin-manage_users.php");
                    }elseif (isset($_POST['reject'])) {
                        $studentId = $_POST['studentId'];
                        // Reject student registration
                        StudentService::rejectStudentRegistration($studentId);
                        
                        echo "<script> alert('User Rejected');
                        </script>";

                    }
                }

                // Get all students
                $students = StudentService::getAllStudents();

                foreach ($students as $student) {
                    assert($student instanceof Student);

                    // Check if the student is not verified
                    if (!$student->isVerified) {
                        echo <<<EOD

                        <div class="registration-record">
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
                            </div>


                            <div class="button-container">
                                <form action="admin-manage_registrations.php" enctype="multipart/form-data" method="POST">
                                    <!-- Hidden input field to store student ID -->
                                    <input type="hidden" name="studentId" value="{$student->StudID}">
                                        <button type="submit" class="btn" name="confirm" value="confirm">Confirm</button>
                                        <button type="submit" class="btn" name="reject" value="reject">Reject</button>
                                </form>
                            </div>

                            

                            
                        </div>
                        EOD;
                    }
                }
            ?>

        </div>

        
    </div>
    
</body>
</html>