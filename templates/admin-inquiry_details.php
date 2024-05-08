<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/InquiryService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/utils/validator.php';

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    header("Location: /");
}
?>

<?php
$inquiryId = $_GET['inquiryId'];
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Perform Validation
    [$status, $error] = validate_many_inputs([
        ["ResponseText", $_POST['replyText'], [new MinLengthRule(5), new MaxLengthRule(20)]]
    ]);

    echo <<<EOD
    <script>
        alert('{$error}');
        document.location.href = '{$_SERVER['REQUEST_URI']}';
    </script>
    EOD;

    if ($status) {
        $inquiryResponse = new InquiryResponse();
        $inquiryResponse->RefInquiryID = $inquiryId;
        $inquiryResponse->ResponseText = $_POST['replyText'];
        InquiryService::adminReplyToInquiry($inquiryResponse);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/admin-inquiry_details.css">
    
</head>

<body>
    <!-- Include Header -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>

    <div class="box">
        <h1 class="sign-up-title">Inquiry Review</h1>

        <?php
        //Backend Start
        // Get Inquiry
        $inquiry = InquiryService::getInquiryById($inquiryId);
        echo <<<EOD
        <div class="message-container user">
            <div class="details">
                <div class="label-styling">Date: <span class="value-styling">{$inquiry->InquiryCreatedAt}</span></div>
                <div class="label-styling">From: <span class="value-styling">{$inquiry->student->getFullName()}</span></div>
                <div class="value-styling" style="margin-top:30px">{$inquiry->InquiryDesc}</div>
            </div>
        </div>
        EOD;

        // Get InquiryResponses
        $inquiryResponses = InquiryService::getInquiryResponses($inquiryId);
        foreach ($inquiryResponses as $inquiryResponse) {
            assert($inquiryResponse instanceof InquiryResponse);
            $responseClass = "";
            $sourceDisplay = "";

            if ($inquiryResponse->ResponseSource == "USER") {
                $responseClass = "user";
                $sourceDisplay = $inquiry->student->getFullName();
            } else {
                $responseClass = "admin";
                $sourceDisplay = "MTG Admin";

            }

            echo <<<EOD
            <div class="message-container {$responseClass}">
                <div class="message-details">
                    <strong>Date: </strong>{$inquiryResponse->ResponseCreatedAt}<br>
                    <strong>From: </strong> {$sourceDisplay}<br>
                </div>
                <div class="message-content">
                {$inquiryResponse->ResponseText}
                </div>
            </div>
            EOD;
        }


        $formLink = $_SERVER['REQUEST_URI'];
        echo <<<EOD
        <form class="reply-box" action="{$formLink}" method="post">
            <textarea placeholder="Write your reply..." style="height: 100px;" name="replyText"></textarea>
            <div class="buttons">
                <button class="button-styling" name="Reply">Send Reply</button>
            </div>
        </form>
        EOD;

        ?>
    </div>

    <!-- Include Footer -->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php"; ?>

</body>

</html>