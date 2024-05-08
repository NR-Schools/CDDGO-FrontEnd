<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/services/InquiryService.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php";

if (!AuthGuard::guard_route(Role::ADMIN)) {
    // Return to root
    header("Location: /");
}
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
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- Include Header-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; ?>

    <!-- Frontend Start -->
    <div class="box">
        <h1 class="page-title">Inquiry Management</h1>
        <?php
        //Backend Start
        $inquiries = InquiryService::getAllInquiries();
        foreach ($inquiries as $inquiry) {
            assert($inquiry instanceof Inquiry);
            $replyLink = "/templates/admin-inquiry_details.php?inquiryId=" . $inquiry->InquiryID;
            echo <<<SHOW_INQUIRIES
            <form class="inquiry" action="admin-manage_inquiries.php" method="post">
                <div class="details">
                    <strong class="label-styling">Name:</strong> <div class="value-styling">{$inquiry->student->getFullName()}</div><br>
                    <strong class="label-styling">Email:</strong> <div class="value-styling">{$inquiry->student->Email}</div><br>
                    <strong class="label-styling">Message:</strong> <div class="value-styling">{$inquiry->InquiryDesc}</div>
                </div>
                <div class="actions">
                    <a class="buttons" href="{$replyLink}">Reply</a>
                    <input type="hidden" name="inquiryId" value="{$inquiry->InquiryID}"> 
                    <button class="buttons" name="Delete">Delete</button>
                </div>
            </form>
            SHOW_INQUIRIES;
        }

        ?>

    </div>

    <!-- Include Footer-->
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php"; ?>
</body>

</html>