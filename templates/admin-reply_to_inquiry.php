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
            <title>Inquiry Reply</title>
            <link type="text/css" rel="stylesheet" href="../css/admin-reply_to_inquiry.css">
        </head>
    <body>
        <!-- Frontend Start -->
        <div class="box">
            <h3>Reply to Inquiry</h3>
            <textarea placeholder="Start writing reply..."></textarea>
                <div>
                    <button class="btn reply">Reply to Inquiry</button>
                    <button class="btn cancel">Cancel</button>
                </div>
        </div>
        <!-- Backend Start -->

    </body>
</html>
