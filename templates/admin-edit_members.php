<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/validator.php';


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
    <title>MTG - Edit Users</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
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
                 // Perform Validation
                [$status, $error] = validate_many_inputs([
                    ["FirstName", $_POST['editFirstname'], [new MinLengthRule(1), new MaxLengthRule(50)]],
                    ["LastName", $_POST['editLastname'], [new MinLengthRule(1), new MaxLengthRule(50)]],
                    ["Email", $_POST['editEmail'], [new MinLengthRule(21), new MaxLengthRule(50), new EmailRule(["@mymail.mapua.edu.ph"])]],
                    ["Program", $_POST['editProgram'], [new MinLengthRule(2), new MaxLengthRule(20)]],
                    ["Password", $_POST['editPassword'], [new MinLengthRule(8), new MaxLengthRule(50)]]
                ]);
                
            if($status){
                $studID = $_POST['studID'];
                $student = StudentService::getStudentById($studID);

                $student->FirstName = $_POST['editFirstname'];
                $student->LastName = $_POST['editLastname'];
                $student->Email = $_POST['editEmail'];
                $student->Program = $_POST['editProgram'];
                $student->Password = $_POST['editPassword'];

                // Check if the student is being made a member
                if(isset($_POST['radioButtons']) && $_POST['radioButtons'] == "memberRadio") {
                    // Handle membership fields                
                    $position = $_POST['memberPosition'];
                    $yearJoined = $_POST['memberYearJoined'];
                    
                    if ($student->member == null) {
                        $student->member = new Member();
                    }
                    
                    $student->member->student = $student;
                    $student->member->Position = $position;
                    $student->member->YearJoined = $yearJoined;
                    
                } else {
                    // If not a member, set member property to null
                    $student->member = null;
                }

                StudentService::updateStudent($student);

                echo "<script> alert('User Updated');
                document.location.href = 'admin-manage_users.php';
                </script>";
            } else {
                echo <<<EOD
                <script>
                    alert('{$error}');
                    document.location.href = '{$_SERVER['REQUEST_URI']}';
                </script>
                EOD;
            }
        }elseif(isset($_POST['cancel'])) {
            echo "<script> document.location.href = 'admin-manage_users.php'; </script>";
        }
    }
        
    ?>

    <form class="row g-3" action="admin-edit_members.php" method="POST" enctype="multipart/form-data">

        <div class="main-container">
            <div class="edit-container">
                <div class="sign-up-title">
                    EDIT USER
                </div>

                <!-- Personal Details -->
                <div class="personal-details">
                    <div class="form-title">Personal Details</div>
                    <div class="divider"></div>
                    <div class="content-container">
                        <div>
                            <label class="label-styling" for="editFirstname">First Name</label>
                            <input class="input-styling" type="text" name="editFirstname" id="feditFirstname" value="<?php echo $student->FirstName; ?>">
                        </div>
                        <div>
                            <label class="label-styling" for="editLastname">Last Name</label>
                            <input class="input-styling" type="text" id="editLastname" name="editLastname" value="<?php echo $student->LastName; ?>">
                        </div>
                    </div>
                </div>

                <!-- School Details -->
                <div class="school-details">
                    <div class="form-title">School Details</div>
                    <div class="divider"></div>
                    <div class="content-container">
                        <div>
                            <label class="label-styling" for="studentNumber">Student Number</label>
                            <input class="input-styling" type="text" id="studentNumber" value="<?php echo $student->StudNo; ?>" readonly>
                        </div>
                        <div>
                            <label class="label-styling" for="editProgram">Progam</label>
                            <input class="input-styling" type="text" id="editProgram" name="editProgram" value="<?php echo $student->Program; ?>">
                        </div>
                    </div>
                </div>

                <!-- Account Details -->
                <div class="account-details">
                    <div class="form-title">Account Details</div>
                    <div class="divider"></div>
                    <div class="content-container">
                        <div>
                            <label class="label-styling" for="editEmail">Email</label>
                            <input class="input-styling" type="text" id="editEmail" name="editEmail" value="<?php echo $student->Email; ?>">
                        </div>
                        <div>
                            <label class="label-styling" for="editPassword">Password</label>
                            <input required class="input-styling" type="password" id="editPassword" name="editPassword" value="<?php echo $student->Password; ?>">
                        </div>
                        <div style="text-align:right">
                            <div>
                                <label class="label-radio" for="memberRadio">Member</label>
                                <input class="radio-but-style" type="radio" name="radioButtons" value="memberRadio" id="memberRadio" <?php echo ($student->member != null) ? "checked" : ""; ?> onclick="showMembershipFields()">
                            </div>
                        </div>
                        <div>
                            <label class="label-radio" for="nonmemberRadio">Non-member</label>
                            <input class="form-check-input" type="radio" name="radioButtons" value="nonmemberRadio" id="nonmemberRadio" <?php echo ($student->member == null) ? "checked" : ""; ?> onclick="hideMembershipFields()">
                        </div>
                    </div>
                    <div class="content-container" id="membershipFields" <?php echo ($student->member == null) ? 'style="display: none;"' : ''; ?>>
                        <div>
                            <label class="label-styling" for="memberPosition">Position</label>
                            <input class="input-styling" type="text" id="memberPosition" name="memberPosition" value="<?php echo ($student->member != null) ? $student->member->Position : ''; ?>">
                        </div>
                        <div style="order:2">
                            <label class="label-styling" for="memberYearJoined">Year Joined</label>
                            <input class="input-styling" type="text" id="memberYearJoined" name="memberYearJoined" value="<?php echo ($student->member != null) ? $student->member->YearJoined : ''; ?>">
                        </div>
                    </div>

                </div>

                <div class="button-container text-center">
                    <input type="hidden" name="studID" id="studID" value="<?php echo $studId; ?>"> 
                    <button type="submit" class="button-styling" name="edit" id="edit">APPLY CHANGES</button>
                    <button type="submit" class="cancel-styling" name="cancel" id="cancel">CANCEL</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        function showMembershipFields() {
            document.getElementById("membershipFields").style.display = "flex";
            
            // Clear fields if the student is not a member
            if (document.getElementById("nonmemberRadio").checked) {
                document.getElementById("memberPosition").value = "";
                document.getElementById("memberYearJoined").value = "";
            }
        }

        function hideMembershipFields() {
            document.getElementById("membershipFields").style.display = "none";
        }

        // Call the appropriate function based on the checked radio button on page load
        window.onload = function() {
            if (document.getElementById("memberRadio").checked) {
                showMembershipFields();
            } else {
                hideMembershipFields();
            }
        };
    </script>



</body>
</html>
