<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

    if (!AuthGuard::guard_route(Role::USER)) {
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
    <link type="text/css" rel="stylesheet" href="../css/user-manage_account.css">
</head>
<body>
    <!-- Include Header -->
    <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    ?>

    <!-- Start Body -->
    <div class="main-body">

        <!-- Loop This Shit -->
        <div class="main-container">
            
            <p class="text-white">MANAGE ACCOUNT</p>

            <form class="row g-3">
                <!-- Personal Details -->
                <p class="text-white">Personal Details</p>
                <hr class="text-white">
                <div class="col-md-6">
                    <label class="form-label text-white" for="editFirstname">First Name</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editFirstname">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-white" for="editLastname">Last Name</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editLastname">
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label text-white" for="editEmail">Email</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="email" class="form-control" id="editEmail">
                    </div>
                </div>

                <!-- School Details -->
                <p class="text-white">School Details</p>
                <hr class="text-white">
                <div class="col-md-6">
                    <label class="form-label text-white" for="studentNumber">Student Number</label>
                    <input type="text" class="form-control" id="studentNumber">
                </div>
                <div class="col-md-6">
                    <label class="form-label text-white" for="editProgram">Program</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editProgram">
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
                        <input type="password" class="form-control" id="editPassword">
                    </div>
                </div>


            </form>
        </div>

        <div class="button-container">
            <button type="button" class="btn">APPLY CHANGES</button>
            <button type="button" class="btn">CANCEL</button>
        </div>

    </div>
</body>
</html>