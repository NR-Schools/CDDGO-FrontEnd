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
            <title>My Inquiries</title>
            <link type="text/css" rel="stylesheet" href="../css/user-inquiries.css">
        </head>
    <body>
        <!-- Frontend Start -->
        <div class="box">
        <h1>My Inquiries</h1>
        <div class="inquiry">
            <div class="details">
                <strong>Date of Inquiry:</strong> May 1, 2024<br>
                <strong>Message:</strong><br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
            </div>
            <div class="actions">
                <button class="btn">View</button>
            </div>
        </div>
        <div class="inquiry">
            <div class="details">
                <strong>Date of Inquiry:</strong> May 1, 2024<br>
                <strong>Message:</strong><br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
            </div>
            <div class="actions">
                <button class="btn">View</button>
            </div>
        </div>
        <div class="inquiry">
            <div class="details">
                <strong>Date of Inquiry:</strong> May 1, 2024<br>
                <strong>Message:</strong><br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
            </div>
            <div class="actions">
                <button class="btn">View</button>
            </div>
        </div>
        <div class="add-inquiry-btn">
            <button class="btn">Add Inquiry</button>
        </div>
    </div>
        <!-- Backend Start -->

    </body>
</html>