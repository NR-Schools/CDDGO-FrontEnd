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
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
