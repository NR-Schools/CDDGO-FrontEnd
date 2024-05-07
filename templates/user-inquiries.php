<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/services/InquiryService.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php";
    #Include Header and Footer
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>

<?php

if (!AuthGuard::guard_route(Role::USER)) {
    // Return to root
    header("Location: /");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>My Inquiries</title>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
            <link type="text/css" rel="stylesheet" href="../css/user-inquiries.css">
        </head>
    <body>
        <!-- Frontend Start -->
        <div class="box">
            <h1 class="sign-up-title">My Inquiries</h1>
            <?php
            [$email, $role] = AuthService::getCurrentlyLoggedIn();
            $inquiries = InquiryService::getInquiriesByStudent($email);
            foreach ($inquiries as $inquiry) {
                assert($inquiry instanceof Inquiry);
                $viewLink = "/templates/user-inquiry_details.php?inquiryId={$inquiry->InquiryID}";
                echo <<<EOD
                <div class="inquiry">
                    <div class="details">
                        <div class="label-styling">Date of Inquiry: <span class="value-styling">{$inquiry->InquiryCreatedAt}</span></div>
                        <div class="label-styling">Title: <span class="value-styling">{$inquiry->InquiryTitle}</span></div>
                        <div class="label-styling">Message: <br> <span class="value-styling">{$inquiry->InquiryDesc}</span></div>
                    </div>
                    <div class="actions">
                        <a href="{$viewLink}">
                            <button class="button-styling" >View</button>
                        </a>
                    </div>
                </div>
                EOD;
            }
            ?>

            <div class="add-inquiry-btn">
                <a href="/templates/user-submit_inquiry.php">
                    <button class="button-styling">Add Inquiry</button>
                </a>
            </div>
        </div>
    </body>
</html>