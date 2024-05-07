<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/InquiryService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";


if (!AuthGuard::guard_route(Role::USER)) {
    // Return to root
    header("Location: /");
}
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{


    // Get Currently Logged In Student
    [$email, $role] = AuthService::getCurrentlyLoggedIn();
    $student = StudentService::getStudentByEmail($email);

    // Construct Inquiry
    $inquiry = new Inquiry();
    $inquiry->InquiryTitle = $_POST['title'];
    $inquiry->InquiryDesc = $_POST['message'];
    $inquiry->student = $student;

    // Submit Inquiry
    InquiryService::createStudentInquiry($inquiry);

    header("Location: /templates/user-inquiries.php");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user-submit_inquiry.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <title>Sign Up</title>
</head>
<body>
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>

    <div class="main-container">
        <form id="inquiryForm" action="user-submit_inquiry.php" method="post" class="sign-up-container">
            <div class="sign-up-title">
                INQUIRY FORM
            </div>
            <div class="personal-details">
                <div class="form-title">Inquiry Information</div>
                <div class="divider"></div>
                <div class="content-container">
                    <div>
                        <label class="label-styling" for="title">Title</label>
                        <input required class="input-styling" type="text" name="title" id="title">
                    </div>
                    <div>
                        <label class="label-styling" for="message">Your Message</label>
                        <textarea class="text-input" id="message" name="message" required></textarea>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <input type="submit" class="button-styling" value="SEND">
                <input type="submit" class="cancel-styling" value="CANCEL">
            </div>
        </form>
    </div>
</body>
</html>

