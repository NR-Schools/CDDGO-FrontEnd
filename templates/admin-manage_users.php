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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_users.css">
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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
                $editLink = "/templates/admin-edit_members.php?studentId=" . $student->StudID;

                echo <<<EOD

                <div class="borrow-record-entry">
                    <div>
                        <span>{$student->StudNo}</span>
                        <span>{$student->FirstName} {$student->LastName}</span>
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