<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");

    if (!AuthGuard::guard_route(Role::ADMIN)) {
        // Return to root
        // header("Location: /");
    }
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
    <link type="text/css" rel="stylesheet" href="../css/admin-inquiry_details.css">
</head>
<body>
        <!-- Frontend Start -->
        <br>
        <h3>Inquiry Review</h3>
        <div class="hrline">
            <hr>
        </div>
        <div class="box">
            <div class="inquiry-info">
                <strong>Name:</strong> John Doe<br>
                <strong>Date of Inquiry:</strong> May 1, 2024<br>
            </div>
            <div class="inquiry-message">
                <strong>Inquiry:</strong><br>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
            </div>
            <div class="actions">
                <button class="btn reply">Add Reply</button>
                <button class="btn cancel">Cancel</button>
            </div>
        </div>
        <!-- Backend Start -->

</body>
</html>
