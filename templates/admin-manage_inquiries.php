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
    <title>Manage Inquiries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_inquiries.css">
</head>
<body>
    <!-- Frontend Start -->
        <br>
        <h3>Inquiry Management</h3>
        <div class="hrline">
            <hr>
        </div>
    <div class="box">
        <div class="inquiry">
            <div class="details">
                <strong>Name:</strong> John Doe<br>
                <strong>Email:</strong> john@example.com<br>
                <strong>Message:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
            </div>
            <div class="actions">
                <button class="btn reply">Reply</button>
                <button class="btn delete">Delete</button>
            </div>
        </div>
        <div class="inquiry">
            <div class="details">
                <strong>Name:</strong> Jane Doe<br>
                <strong>Email:</strong> jane@example.com<br>
                <strong>Message:</strong> Nulla quis sem at nibh elementum imperdiet.
            </div>
            <div class="actions">
                <button class="btn reply">Reply</button>
                <button class="btn delete">Delete</button>
            </div>
        </div>
        <div class="inquiry">
            <div class="details">
                <strong>Name:</strong> Alex Smith<br>
                <strong>Email:</strong> alex@example.com<br>
                <strong>Message:</strong> Sed cursus ante dapibus diam.
            </div>
            <div class="actions">
                <button class="btn reply">Reply</button>
                <button class="btn delete">Delete</button>
            </div>
        </div>
        <div class="inquiry">
            <div class="details">
                <strong>Name:</strong> Alex Smith<br>
                <strong>Email:</strong> alex@example.com<br>
                <strong>Message:</strong> Sed cursus ante dapibus diam.
            </div>
            <div class="actions">
                <button class="btn reply">Reply</button>
                <button class="btn delete">Delete</button>
            </div>
        </div>
        <div class="inquiry">
            <div class="details">
                <strong>Name:</strong> Alex Smith<br>
                <strong>Email:</strong> alex@example.com<br>
                <strong>Message:</strong> Sed cursus ante dapibus diam.
            </div>
            <div class="actions">
                <button class="btn reply">Reply</button>
                <button class="btn delete">Delete</button>
            </div>
        </div>
        <div class="inquiry">
            <div class="details">
                <strong>Name:</strong> Emily Johnson<br>
                <strong>Email:</strong> emily@example.com<br>
                <strong>Message:</strong> Nullam quis risus eget urna mollis ornare vel eu leo.
            </div>
            <div class="actions">
                <button class="btn reply">Reply</button>
                <button class="btn delete">Delete</button>
            </div>
        </div>
    </div>
        <!-- Backend Start -->

</body>
</html>
