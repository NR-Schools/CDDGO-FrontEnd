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
    <title>Document</title>
    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_users.css">
</head>
<body>
    <!-- Include Header -->
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Start Body -->
    <div class="main-body">
        <div class="event-title">
            USER MANAGEMENT
        </div>
        <div class="divider-container">
            <div class="divider"></div>
        </div>

        <div class="users-list-container">
            <?php
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

                        <div class="user-record">
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
                                <button type="button" class="btn btn-danger">Delete</button>
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