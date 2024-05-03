<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

    if (!AuthGuard::guard_route(Role::ADMIN)) {
        // Return to root
        // header("Location: /");
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
        <p>USER MANAGEMENT</p>

        <hr />

        <?php
            // Get all students
            $students = StudentService::getAllStudents();

            foreach ($students as $student) {
                assert($student instanceof Student);

                $membershipStatus = $student->isVerified ? "member" : "non-member";
                $editLink = "/templates/admin-edit_members.php?studId=" . $student->StudID;

                echo <<<EOD

                <div class="borrow-record-entry">
                    <div>
                        <span>{$student->StudNo}</span>
                        <span>{$student->getFullName()}</span>
                        <span>{$student->Email}</span>
                        <span>{$student->Program}</span>
                        <span>{$membershipStatus}</span>
                        
                    </div>
                    <div>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='{$editLink}'">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
                EOD;
            }
        ?>
    </div>
</body>
</html>