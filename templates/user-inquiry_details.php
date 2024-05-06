<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/InquiryService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php";
#Include Header and Footer
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>

<?php
$inquiryId = $_GET['inquiryId'];
?>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $inquiryResponse = new InquiryResponse();
    $inquiryResponse->RefInquiryID = $inquiryId;
    $inquiryResponse->ResponseText = $_POST['replyText'];
    InquiryService::adminReplyToInquiry($inquiryResponse);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Details</title>
    <link type="text/css" rel="stylesheet" href="../css/user-inquiry_details.css">
</head>

<body>
    <!-- Frontend Start -->
    <div class="box">

        <?php
        // Get Inquiry
        $inquiry = InquiryService::getInquiryById($inquiryId);
        echo <<<EOD
        <div class="message-container user">
            <div class="message-details">
                <strong>Date:</strong>{$inquiry->InquiryCreatedAt}<br>
                <strong>From:</strong> User<br>
            </div>
            <div class="message-content">
            {$inquiry->InquiryDesc}
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
                $sourceDisplay = "admin@email.com";

            }

            echo <<<EOD
            <div class="message-container {$responseClass}">
                <div class="message-details">
                    <strong>Date:</strong>{$inquiryResponse->ResponseCreatedAt}<br>
                    <strong>From:</strong> {$sourceDisplay}<br>
                </div>
                <div class="message-content">
                {$inquiryResponse->ResponseText}
                </div>
            </div>
            EOD;
        }

        $formLink = $_SERVER['REQUEST_URI'];
        echo<<<EOD
        <form class="reply-box" action="{$formLink}" method="post">
            <textarea placeholder="Write your reply..." style="height: 100px;" name="replyText"></textarea>
            <div class="buttons">
                <button class="btn" name="Reply">Send Reply</button>
            </div>
        </form>
        EOD;
        ?>
    </div>
    <!-- Backend Start -->

</body>

</html>