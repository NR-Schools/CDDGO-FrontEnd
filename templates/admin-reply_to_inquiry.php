<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/services/InquiryService.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    // header("Location: /");
}
#Include Header and Footer
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>



<?php

$inquiryId = $_GET['inquiryId'];

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
    <title>Inquiry Reply</title>
    <link type="text/css" rel="stylesheet" href="../css/admin-reply_to_inquiry.css">
</head>

<body>
    <?php
    $formLink = $_SERVER['REQUEST_URI'];
    $backLink = "/templates/admin-inquiry_details.php?inquiryId=" . $inquiryId;

    echo <<<EOD
    <form class="box" action="{$formLink}" method="post">
        <h3>Reply to Inquiry</h3>
        <textarea placeholder="Start writing reply..." name="replyText"></textarea>
        <div>
            <button class="btn reply">Reply to Inquiry</button>
            <a class="btn cancel" href="{$backLink}">Cancel</a>
        </div>
    </form>
    EOD;
    ?>

    

</body>

</html>