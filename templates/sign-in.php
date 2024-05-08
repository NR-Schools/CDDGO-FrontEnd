<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/validator.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sign-in.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Sign In</title>
</head>

<body>
    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>

    <div class="main-container">
        <div class="login-container">
            <div class="logo-container">
                <div>
                    <img class="image-styling" src="../assets/mtg-logo.jpg" alt="">
                </div>
                <div class="divider"></div>
                <div class="logo-title">
                    MAPÚA TABLE TOP <br> GAMERS
                </div>
                <div class="logo-description">
                    Learn and play with <br> Mapùa's tabletop gamers
                </div>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="login-components">
                <div class="login-title">
                    LOGIN ACCOUNT
                </div>
                <div>
                    <label class="cred-username" for="">Username</label>
                    <input class="cred-input" type="text" name="email" id="email">
                </div>
                <div>
                    <label class="cred-password" for="">Password</label>
                    <input class="cred-input" type="password" name="password" id="password">
                </div>
                <div>
                    <button class="login-styling">LOGIN</button>
                </div>
                <div class="not-registered-button">
                    Not registered?
                </div>
                <div>
                    <a class="sign-up-button" href="../templates/sign-up.php">Sign-Up</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>
</body>

</html>



<?php

// When trying to log in, load the html first before checking log in

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Perform Validation
    [$status, $error] = validate_many_inputs([
        ["Email", $_POST['email'], [new MinLengthRule(5), new MaxLengthRule(40)]],
        ["Password", $_POST['password'], [new MinLengthRule(5), new MaxLengthRule(20)]]
    ]);

    if ($status) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        [$status, $error] = AuthService::login($email, $password);

        if (!$status) {
            echo <<<EOD
            <script>
                alert("{$error}");
            </script>
            EOD;
            return;
        }

        // redirect to correct home page based on role
        [$email, $role] = AuthService::getCurrentlyLoggedIn();
        assert($role instanceof Role);


        if ($role === Role::ADMIN) {
            header("Location: /templates/admin-homepage.php");
        } else {
            header("Location: /templates/user-homepage.php");
        }
    }
    else {
        echo <<<EOD
        <script>
            alert('{$error}');
            document.location.href = '{$_SERVER['REQUEST_URI']}';
        </script>
        EOD;
    }
}

?>