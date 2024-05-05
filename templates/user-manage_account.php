<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

    if (!AuthGuard::guard_route(Role::USER)) {
        // Return to root
        // header("Location: /");
    }

    // Fetch currently logged-in user data
    [$email, $role] = AuthService::getCurrentlyLoggedIn();
    $student = StudentService::getStudentByEmail($email);

    // Radio button member/non-member handling
    $isMember = ($student->member != null) ? 'checked' : '';
    $isNonMember = ($student->member == null) ? 'checked' : '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['edit'])) {

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

            echo "<script> alert('Account Updated');
            document.location.href = 'user-homepage.php';
            </script>";
        }
        elseif(isset($_POST['cancel'])) {
            echo "<script> document.location.href = 'user-homepage.php'; </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Account</title>
    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="../css/user-manage_account.css">
</head>
<body>
    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>

    <!-- Start Body -->
    <div class="main-body">
        <!-- Main Container -->
        <div class="main-container">
            <p class="text-white">MANAGE ACCOUNT</p>
            <!-- Account Form -->
            <form class="row g-3" action="user-manage_account.php" method="POST" enctype="multipart/form-data">
                <!-- Personal Details -->
                <p class="text-white">Personal Details</p>
                <hr class="text-white">
                <!-- First Name -->
                <div class="col-md-6">
                    <label class="form-label text-white" for="editFirstname">First Name</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editFirstname" name="editFirstname" value="<?php echo $student->FirstName; ?>">
                    </div>
                </div>
                <!-- Last Name -->
                <div class="col-md-6">
                    <label class="form-label text-white" for="editLastname">Last Name</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="text" class="form-control" id="editLastname" name="editLastname" value="<?php echo $student->LastName; ?>">
                    </div>
                </div>
                <!-- Email -->
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
                <!-- Student Number -->
                <div class="col-md-6">
                    <label class="form-label text-white" for="studentNumber">Student Number</label>
                    <input type="text" class="form-control" id="studentNumber" value="<?php echo $student->StudNo; ?>" readonly>
                </div>
                <!-- Program -->
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
                <!-- Password -->
                <div class="col-md-6">
                    <label class="form-label text-white" for="editPassword">Password</label>
                    <div class="input-group">
                        <div class="input-group-text">Edit Icon</div>
                        <input type="password" class="form-control" id="editPassword" name="editPassword" value="<?php echo $student->Password; ?>">
                    </div>
                </div>
                <!-- Membership Radio Buttons -->
                <div class="form-check col-md-2">
                    <input class="form-check-input" type="radio" name="radioButtons" value="memberRadio" id="memberRadio" onclick="showMembershipFields()" <?php echo $isMember; ?> disabled>
                    <label class="form-check-label text-white" for="memberRadio">Member</label>
                </div>
                <div class="form-check col-md-3">
                    <input class="form-check-input" type="radio" name="radioButtons" value="nonmemberRadio" id="nonmemberRadio" onclick="hideMembershipFields()" <?php echo $isNonMember; ?> disabled>
                    <label class="form-check-label text-white" for="nonmemberRadio">Non-member</label>
                </div>
                <!-- Membership Fields -->
                <div id="membershipFields" style="display: <?php echo ($isMember == 'checked') ? 'block' : 'none'; ?>">
                    <div class="col-md-6">
                        <label class="form-label text-white" for="memberPosition">Position</label>
                        <input type="text" class="form-control" id="memberPosition" name="memberPosition" value="<?php echo $student->member->Position; ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-white" for="memberYearJoined">Year Joined</label>
                        <input type="text" class="form-control" id="memberYearJoined" name="memberYearJoined" value="<?php echo $student->member->YearJoined; ?>" readonly>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="button-container text-center">
                    <button type="submit" class="btn" name="edit" id="edit">APPLY CHANGES</button>
                    <button type="submit" class="btn" name="cancel" id="cancel">CANCEL</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Script to handle show/hide of membership fields -->
    <script>
        function showMembershipFields() {
            document.getElementById("membershipFields").style.display = "block";
        }

        function hideMembershipFields() {
            document.getElementById("membershipFields").style.display = "none";
        }
    </script>
</body>
</html>
