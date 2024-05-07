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
    //header("Location: /");
}

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
        
        <?php
        [$email, $role] = AuthService::getCurrentlyLoggedIn();
        $inquiries = InquiryService::getInquiriesByStudent($email);
        foreach ($inquiries as $inquiry) {
            assert($inquiry instanceof Inquiry);
            $viewLink = "/templates/user-inquiry_details.php?inquiryId={$inquiry->InquiryID}";
            echo <<<EOD
            <div class="inquiry">
                <div class="details">
                    <strong>Date of Inquiry:</strong>{$inquiry->InquiryCreatedAt}<br>
                    <strong>Title:</strong><br> {$inquiry->InquiryTitle} <br><br>
                    <strong>Message:</strong><br> {$inquiry->InquiryDesc}
                </div>
                <div class="actions">
                    <a href="{$viewLink}" class="btn">View</a>
                </div>
            </div>
            EOD;
        }
        ?>

        <div class="add-inquiry-btn">
            <a href="/templates/user-submit_inquiry.php" class="btn">Add Inquiry</a>
        </div>
    </div>
        <!-- Backend Start -->
        <?php
        
        ?>
    </body>
</html>