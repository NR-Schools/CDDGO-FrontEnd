<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/InquiryService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php";

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    header("Location: /");
}

#Include Header and Footer
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
?>


<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['Delete']))
    {
        $inquiryId = $_POST['inquiryId'];
        InquiryService::adminRemoveInquiry($inquiryId);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inquiries</title>
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

        <?php
        //Backend Start
        $inquiries = InquiryService::getAllInquiries();
        foreach ($inquiries as $inquiry) {
            assert($inquiry instanceof Inquiry);
            $replyLink = "/templates/admin-inquiry_details.php?inquiryId=" . $inquiry->InquiryID;
            echo <<<SHOW_INQUIRIES
            <form class="inquiry" action="admin-manage_inquiries.php" method="post">
                <div class="details">
                    <strong>Name:</strong> {$inquiry->student->getFullName()}<br>
                    <strong>Email:</strong> {$inquiry->student->Email}<br>
                    <strong>Message:</strong> {$inquiry->InquiryDesc}
                </div>
                <div class="actions">
                    <a class="btn reply" href="{$replyLink}">Reply</a>
                    <input type="hidden" name="inquiryId" value="{$inquiry->InquiryID}"> 
                    <button class="btn delete" name="Delete">Delete</button>
                </div>
            </form>
            SHOW_INQUIRIES;
        }

        ?>

    </div>
</body>

</html>