<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/guards/AuthGuard.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/validator.php';

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
    if (isset($_POST['edit'])) {

        // Perform Validation
        [$status, $error] = validate_many_inputs([
            ["FirstName", $_POST['editFirstname'], [new MinLengthRule(1), new MaxLengthRule(50)]],
            ["LastName", $_POST['editLastname'], [new MinLengthRule(1), new MaxLengthRule(50)]],
            ["Email", $_POST['editEmail'], [new MinLengthRule(21), new MaxLengthRule(50), new EmailRule(["@mymail.mapua.edu.ph"])]],
            ["Program", $_POST['editProgram'], [new MinLengthRule(2), new MaxLengthRule(20)]],
        ]);

        // Only Update Password when Changed {1}
        if (strlen($_POST["editPassword"]) > 0) {
            [$pass_status, $pass_error] = validate_many_inputs([
                ["Password", $_POST['editPassword'], [new MinLengthRule(8), new MaxLengthRule(50)]]
            ]);

            global $isPasswordUpdated;
            $isPasswordUpdated = false;
            if ($pass_status) {
                $isPasswordUpdated = true;
            } else {
                echo <<<EOD
                <script>
                    alert('{$pass_error}, Password will not be updated');
                </script>
                EOD;
            }
        }

        // Update User Info
        if ($status) {
            $student->FirstName = $_POST['editFirstname'];
            $student->LastName = $_POST['editLastname'];
            $student->Email = $_POST['editEmail'];
            $student->Program = $_POST['editProgram'];
            $student->Password = $_POST['editPassword'];

            // Only Update Password when Changed {2}
            if ($isPasswordUpdated) {
                $student->Password = $_POST['editPassword'];
            }

            // Check if the student is being made a member
            if (isset($_POST['radioButtons']) && $_POST['radioButtons'] == "memberRadio") {
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
        } else {
            echo <<<EOD
            <script>
                alert('{$error}');
                document.location.href = '{$_SERVER['REQUEST_URI']}';
            </script>
            EOD;
        }

    } elseif (isset($_POST['cancel'])) {
        echo "<script> document.location.href = 'user-homepage.php'; </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user-manage_account.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>MTG - Manage Account</title>
</head>

<body>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>
    <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST" enctype="multipart/form-data">
        <div class="main-container">
            <div class="sign-up-container">
                <div class="sign-up-title">
                    MANAGE ACCOUNT
                </div>
                <div class="personal-details">
                    <div class="form-title">Personal Details</div>
                    <div class="divider"></div>
                    <div class="content-container">
                        <div>
                            <label class="label-styling" for="editFirstname">First Name</label>
                            <input class="input-styling" type="text" name="editFirstname" id="feditFirstname"
                                value="<?php echo $student->FirstName; ?>">
                        </div>
                        <div>
                            <label class="label-styling" for="editLastname">Last Name</label>
                            <input class="input-styling" type="text" id="editLastname" name="editLastname"
                                value="<?php echo $student->LastName; ?>">
                        </div>
                    </div>
                </div>
                <div class="school-details">
                    <div class="form-title">School Details</div>
                    <div class="divider"></div>
                    <div class="content-container">
                        <div>
                            <label class="label-styling" for="studentNumber">Student Number</label>
                            <input class="input-styling" type="text" id="studentNumber"
                                value="<?php echo $student->StudNo; ?>" readonly>
                        </div>
                        <div>
                            <label class="label-styling" for="editProgram">Progam</label>
                            <input class="input-styling" type="text" id="editProgram" name="editProgram"
                                value="<?php echo $student->Program; ?>">
                        </div>
                    </div>
                </div>
                <div class="account-details">
                    <div class="form-title">Account Details</div>
                    <div class="divider"></div>
                    <div class="content-container">
                        <div>
                            <label class="label-styling" for="editEmail">Email</label>
                            <input class="input-styling" type="text" id="editEmail" name="editEmail"
                                value="<?php echo $student->Email; ?>">
                        </div>
                        <div>
                            <label class="label-styling" for="editPassword">Password</label>
                            <input class="input-styling" type="password" id="editPassword" name="editPassword"
                                placeholder="Change your password by entering new password here!">
                        </div>
                        <div style="text-align:right">
                            <div>
                                <label class="label-radio" for="memberRadio">Member</label>
                                <input class="radio-but-style" type="radio" name="radioButtons" value="memberRadio"
                                    id="memberRadio" onclick="showMembershipFields()" <?php echo $isMember; ?> disabled>
                            </div>
                        </div>
                        <div>
                            <label class="label-radio" for="nonmemberRadio">Non-member</label>
                            <input class="radio-but-style" type="radio" name="radioButtons" value="nonmemberRadio"
                                id="nonmemberRadio" onclick="hideMembershipFields()" <?php echo $isNonMember; ?>
                                disabled>
                        </div>
                    </div>

                    <div class="content-container" id="membershipFields"
                        style="display: <?php echo ($isMember == 'checked') ? 'flex' : 'none'; ?>">
                        <div>
                            <label class="label-styling" for="memberPosition">Position</label>
                            <input class="input-styling" type="text" id="memberPosition" name="memberPosition"
                                value="<?php echo $student->member->Position; ?>" readonly>
                        </div>
                        <div style="order:2">
                            <label class="label-styling" for="memberYearJoined">Year Joined</label>
                            <input class="input-styling" type="text" id="memberYearJoined" name="memberYearJoined"
                                value="<?php echo $student->member->YearJoined; ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="button-container">
                    <input type="submit" class="button-styling" name="edit" id="edit" value="APPLY CHANGES">
                    <input type="submit" class="cancel-styling" name="cancel" id="cancel" value="CANCEL">
                </div>
            </div>
        </div>
    </form>
    <script>
        function showMembershipFields() {
            document.getElementById("membershipFields").style.display = "flex";
        }

        function hideMembershipFields() {
            document.getElementById("membershipFields").style.display = "none";
        }
    </script>
</body>

</html>