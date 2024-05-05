<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
#Include Header and Footer
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>


<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Get Currently Logged In Student
    [$email, _] = AuthService::getCurrentlyLoggedIn();
    $student = StudentRepository::getStudentByEmail($email);

    // Construct Inquiry
    $inquiry = new Inquiry();
    $inquiry->InquiryTitle = $_POST['title'];
    $inquiry->InquiryDesc = $_POST['message'];
    $inquiry->student = $student;

    // Submit Inquiry
    InquiryService::createStudentInquiry($inquiry);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add an Inquiry</title>
    <link type="text/css" rel="stylesheet" href="../css/user-submit_inquiry.css">
</head>

<body>
    <!-- Frontend Start -->
    <div class="box">
        <h1>Inquiry Form</h1>
        <form id="inquiryForm" action="user-submit_inquiry.php" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div class="btn-container">
                <button type="button" class="btn">Submit</button>
                <button type="button" class="btn cancel">Cancel</button>
            </div>
        </form>
    </div>
    <!-- Backend Start -->

</body>

</html>