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
    <link type="text/css" rel="stylesheet" href="../css/admin-edit_members.css">
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

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['edit'])) {
                $studID = $_POST['studID'];
                $student = StudentService::getStudentById($studID);

                $student->FirstName = $_POST['editFirstname'];
                $student->LastName = $_POST['editLastname'];
                $student->Email = $_POST['editEmail'];
                $student->Program = $_POST['editProgram'];
                $student->Password = $_POST['editPassword'];

                StudentService::updateStudent($student);

                echo "<script> alert('User Updated');
                document.location.href = 'admin-manage_users.php';
                </script>";
            }
            elseif(isset($_POST['cancel'])) {
                echo "<script> document.location.href = 'admin-manage_users.php'; </script>";
            }
        }
        
    ?>



    <!-- Start Body -->
    <div class="main-body">

        <div class="main-container">
            
            <p class="text-white">EDIT USER</p>

            <form class="row g-3" action="admin-edit_members.php" method="POST" enctype="multipart/form-data">
                <!-- Personal Details -->
                <p class="text-white">Personal Details</p>
                <hr class="text-white">
                <div class="col-md-6">
                    <label class="form-label text-white" for="editFirstname">First Name</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editFirstname" name="editFirstname" value="<?php echo $student->FirstName; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-white" for="editLastname">Last Name</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editLastname" name="editLastname" value="<?php echo $student->LastName; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label text-white" for="editEmail">Email</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="email" class="form-control" id="editEmail" name="editEmail" value="<?php echo $student->Email; ?>">
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
                        <input type="text" class="form-control" id="editProgram" name="editProgram" value="<?php echo $student->Program; ?>">
                    </div>
                </div>

                <!-- Account Details -->
                <p class="text-white">Account Details</p>
                <hr class="text-white">
                <div class="col-md-6">
                    <label class="form-label text-white" for="editPassword">Password</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="password" class="form-control" id="editPassword" name="editPassword" value="<?php echo $student->Password; ?>">
                    </div>
                </div>
                <div class="form-check col-md-2">
                    <input class="form-check-input" type="radio" name="radioButtons" id="memberRadio">
                    <label class="form-check-label text-white" for="memberRadio">Member</label>
                </div>
                <div class="form-check col-md-3">
                    <input class="form-check-input" type="radio" name="radioButtons" id="nonmemberRadio" checked>
                    <label class="form-check-label text-white" for="nonmemberRadio">Non-member</label>
                </div>
                <div class="button-container text-center">
                    <input type="hidden" name="studID" id="studID" value="<?php echo $studId; ?>"> 
                    <button type="submit" class="btn" name="edit" id="edit">APPLY CHANGES</button>
                    <button type="submit" class="btn" name="cancel" id="cancel">CANCEL</button>
                </div>
            </form>
        </div>

    </div>
</body>
</html>