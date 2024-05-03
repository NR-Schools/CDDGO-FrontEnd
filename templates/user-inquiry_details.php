<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
    #Include Header and Footer
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
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
        <div class="message-container user">
            <div class="message-details">
                <strong>Date:</strong> May 1, 2024<br>
                <strong>From:</strong> User<br>
            </div>
            <div class="message-content">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
            </div>
        </div>

        <!-- Admin Replies -->
        <div class="message-container admin">
            <div class="message-details">
                <strong>Date:</strong> May 2, 2024<br>
                <strong>From:</strong> Admin<br>
            </div>
            <div class="message-content">
                Reply from Admin Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
            </div>
        </div>

        <!-- Reply Box -->
        <div class="reply-box">
            <textarea placeholder="Write your reply..." style="height: 100px;"></textarea>
            <div class="buttons">
                <button class="btn">Send Reply</button>
                <button class="btn cancel">Cancel</button>
            </div>
        </div>
    </div>
        <!-- Backend Start -->

    </body>
</html>