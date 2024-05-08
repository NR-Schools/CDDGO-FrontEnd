<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/validator.php';
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Perform Validation
    [$status, $error] = validate_many_inputs([
        ["First Name", $_POST['fname'], [new MinLengthRule(5), new MaxLengthRule(50)]],
        ["Last Name", $_POST['lname'], [new MinLengthRule(5), new MaxLengthRule(50)]],
        ["Email", $_POST['email'], [new MinLengthRule(5), new MaxLengthRule(40)]],
        ["Student Number", $_POST['studentNumber'], [new MinLengthRule(10), new MaxLengthRule(10)]],
        ["Program", $_POST['program'], [new MinLengthRule(5), new MaxLengthRule(20)]],
        ["Password", $_POST['password'], [new MinLengthRule(5), new MaxLengthRule(20)]],
    ]);

    echo <<<EOD
    <script>
        alert('{$error}');
        document.location.href = '{$_SERVER['REQUEST_URI']}';
    </script>
    EOD;

    if ($status) {
        $student = new Student();
        $student->FirstName = $_POST['fname'];
        $student->LastName = $_POST['lname'];
        $student->Email = $_POST['email'];
        $student->StudNo = $_POST['studentNumber'];
        $student->Program = $_POST['program'];
        $student->Password = $_POST['password'];

        // Save Student
        AuthService::signup($student);

        // Redirect to sign in page
        header("Location: ../templates/sign-in.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sign-up.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Sign Up</title>
</head>

<body>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>

    <div class="main-container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="sign-up-container">
            <div class="sign-up-title">
                SIGN-UP ACCOUNT
            </div>
            <div class="personal-details">
                <div class="form-title">Personal Details</div>
                <div class="divider"></div>
                <div class="content-container">
                    <div>
                        <label class="label-styling" for="">First Name</label>
                        <input required class="input-styling" type="text" name="fname" id="fname">
                    </div>
                    <div>
                        <label class="label-styling" for="">Last Name</label>
                        <input required class="input-styling" type="text" name="lname" id="lname">
                    </div>
                </div>
            </div>
            <div class="school-details">
                <div class="form-title">School Details</div>
                <div class="divider"></div>
                <div class="content-container">
                    <div>
                        <label class="label-styling" for="">Student Number</label>
                        <input required class="input-styling" type="text" name="studentNumber" id="studentNumber">
                    </div>
                    <div>
                        <label class="label-styling" f or="">Progam</label>
                        <input required class="input-styling" type="text" name="program" id="program">
                    </div>
                </div>
            </div>
            <div class="account-details">
                <div class="form-title">Account Details</div>
                <div class="divider"></div>
                <div class="content-container">
                    <div>
                        <label class="label-styling" for="">Email</label>
                        <input required class="input-styling" type="text" name="email" id="email">
                    </div>
                    <div>
                        <label class="label-styling" for="">Password</label>
                        <input required class="input-styling" type="password" name="password" id="password">
                    </div>
                </div>
            </div>
            <div class="button-container">
                <input type="submit" class="button-styling" value="SIGN-UP">
            </div>
        </form>
    </div>
</body>

</html>