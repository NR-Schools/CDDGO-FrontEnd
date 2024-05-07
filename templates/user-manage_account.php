<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';

    if (!AuthGuard::guard_route(Role::USER)) {
        // Return to root
        header("Location: /");
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

    <div class="content-container">
        <div class="manage-account-title">
            <p>MANAGE ACCOUNT</p>
        </div>
        <!-- Account Form -->
        <form class="row g-3" action="user-manage_account.php" method="POST" enctype="multipart/form-data">
            <!-- Personal Details -->
            <p class="title-styling">Personal Details</p>
            <div class="divider-container">
                <div class="divider"></div>
            </div>
            <!-- First Name -->
            <div class="col-md-6">
                <label class="form-label" for="editFirstname">First Name</label>
                <input type="text" class="form-control" id="editFirstname" name="editFirstname" value="<?php echo $student->FirstName; ?>">
            </div>
            <!-- Last Name -->
            <div class="col-md-6">
                <label class="form-label" for="editLastname">Last Name</label>
                    <input type="text" class="form-control" id="editLastname" name="editLastname" value="<?php echo $student->LastName; ?>">
            </div>
            <!-- Email -->
            <div class="col-6">
                <label class="form-label" for="editEmail">Email</label>
                <input type="email" class="form-control" id="editEmail" name="editEmail" value="<?php echo $student->Email; ?>">
            </div>
            <!-- School Details -->
            <p class="title-styling">School Details</p>
            <div class="divider-container">
                <div class="divider"></div>
            </div>
            <!-- Student Number -->
            <div class="col-md-6">
                <label class="form-label" for="studentNumber">Student Number</label>
                <input type="text" class="form-control" id="studentNumber" value="<?php echo $student->StudNo; ?>" readonly>
            </div>
            <!-- Program -->
            <div class="col-md-6">
                <label class="form-label" for="editProgram">Program</label>
                <input type="text" class="form-control" id="editProgram" name="editProgram" value="<?php echo $student->Program; ?>">
            </div>
            <!-- Account Details -->
            <p class="title-styling">Account Details</p>
            <div class="divider-container">
                <div class="divider"></div>
            </div>
            <!-- Password -->
            <div class="col-md-6">
                <label class="form-label" for="editPassword">Password</label>
                <input type="password" class="form-control" id="editPassword" name="editPassword" value="<?php echo $student->Password; ?>">
            </div>
            <!-- Membership Radio Buttons -->
            <div class="col-md-6 radio-buttons">
                <div class="form-check col-md-6">
                    <input class="form-check-input" type="radio" name="radioButtons" value="memberRadio" id="memberRadio" onclick="showMembershipFields()" <?php echo $isMember; ?> disabled>
                    <label class="form-check-label" for="memberRadio">Member</label>
                </div>
                <div class="form-check col-md-6">
                    <input class="form-check-input" type="radio" name="radioButtons" value="nonmemberRadio" id="nonmemberRadio" onclick="hideMembershipFields()" <?php echo $isNonMember; ?> disabled>
                    <label class="form-check-label" for="nonmemberRadio">Non-member</label>
                </div>
            </div>
            
            <!-- Membership Fields -->
            <div id="membershipFields" class="membership-fields" style="display: <?php echo ($isMember == 'checked') ? 'flex' : 'none'; ?>">
                <div class="col-md-6 position">
                    <label class="form-label" for="memberPosition">Position</label>
                    <input type="text" class="form-control" id="memberPosition" name="memberPosition" value="<?php echo $student->member->Position; ?>" readonly>
                </div>
                <div class="col-md-6 yearJoined">
                    <label class="form-label" for="memberYearJoined">Year Joined</label>
                    <input type="text" class="form-control" id="memberYearJoined" name="memberYearJoined" value="<?php echo $student->member->YearJoined; ?>" readonly>
                </div>
            </div>
            <!-- Buttons -->
            <div class="button-container text-center">
                <button type="submit" class="btn-submit" name="edit" id="edit">APPLY CHANGES</button>
                <button type="submit" class="btn-cancel" name="cancel" id="cancel">CANCEL</button>
            </div>
        </form>
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
