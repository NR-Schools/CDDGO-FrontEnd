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
    <title>Edit Users</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/admin-edit_members.css">
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

    <!-- Edit User -->
    <?php

        if(isset($_GET['studId'])) {
            $studId = $_GET['studId'];
            $student = StudentService::getStudentById($studId);
            if($student == null){
                echo "<script> alert('Invalid Student');
                </script>";
            }
        }
        
    ?>



    <!-- Start Body -->
    <div class="main-body">

        <div class="main-container">
            
            <p class="text-white">EDIT USER</p>

            <form class="row g-3">
                <!-- Personal Details -->
                <p class="text-white">Personal Details</p>
                <hr class="text-white">
                <div class="col-md-6">
                    <label class="form-label text-white" for="editFirstname">First Name</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editFirstname" value="<?php echo $student->FirstName; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-white" for="editLastname">Last Name</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editLastname" value="<?php echo $student->LastName; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label text-white" for="editEmail">Email</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="email" class="form-control" id="editEmail" value="<?php echo $student->Email; ?>">
                    </div>
                </div>

                <!-- School Details -->
                <p class="text-white">School Details</p>
                <hr class="text-white">
                <div class="col-md-6">
                    <label class="form-label text-white" for="studentNumber">Student Number</label>
                    <input type="text" class="form-control" id="studentNumber" value="<?php echo $student->StudNo; ?>" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-white" for="editProgram">Program</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editProgram" value="<?php echo $student->Program; ?>">
                    </div>
                </div>

                <!-- Account Details -->
                <p class="text-white">Account Details</p>
                <hr class="text-white">
                <div class="col-md-6">
                    <label class="form-label text-white" for="editUsername">Username</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editUsername">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-white" for="editPassword">Password</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="password" class="form-control" id="editPassword" value="<?php echo $student->Password; ?>">
                    </div>
                </div>
                <div class="form-check col-md-3">
                    <input class="form-check-input" type="radio" name="radioButtons" id="memberRadio">
                    <label class="form-check-label text-white" for="memberRadio">Member</label>
                </div>
                <div class="form-check col-md-3">
                    <input class="form-check-input" type="radio" name="radioButtons" id="nonmemberRadio" checked>
                    <label class="form-check-label text-white" for="nonmemberRadio">Non-member</label>
                </div>
                <div class="button-container text-center">
                    <button type="button" class="btn">APPLY CHANGES</button>
                    <button type="button" class="btn">CANCEL</button>
                </div>
            </form>
        </div>

    </div>
</body>
</html>