<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/StudentService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/AuthService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/TestimonialService.php");


    //get gameID
    if(isset($_GET["gameId"]))
    {
        $gameID = $_GET["gameId"];

        $game = BoardGameService::getBoardGameById($gameID);
        if ($game == null)
        {
            echo "No game.";
        }
        
    }

    [$email, $role] = AuthService::getCurrentlyLoggedIn();
    $currentUser = StudentService::getStudentByEmail($email);
    $testimonials = TestimonialService::getAllTestimonials();

    $queryGetTestimonial = "SELECT * FROM testimonials WHERE GameID = $gameID";
    $queryGetMember = "SELECT * FROM members WHERE MemberID = $currentUser->StudID";
    $checkMember = Database::SQLwithFetch(Database::getPDO(), $queryGetMember);
    $checkTestimonial = Database::SQLwithFetch(Database::getPDO(), $queryGetTestimonial);

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['memberReview']))
            {
                $reviewUser = $_POST["studEmail"];
                $reviewContent = $_POST["review"];
                $gameReviewed = (int)$_POST["reviewedGame"];
                $rating = 5;
                
                $getReviewer = StudentService::getStudentByEmail($reviewUser);
                $testimonial = new Testimonial();
                
                $testimonial->student->StudID = $getReviewer->StudID;
                $testimonial->boardGame->GameID = $gameReviewed;
                $testimonial->Statement = $reviewContent;
                $testimonial->Rating = $rating;
                
                TestimonialService::addMemberTestimonial($reviewUser, $testimonial);
                
                echo "Testimonial added.";
    
            }
    
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/user-board_game_details.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Board Game Details</title>
</head>
<body>
        <!-- Include Header and Footer-->
        <?php 
            require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
            require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
        ?>

        <!--Content Start For non-members-->
        <div class="main-container">
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="left-column">
                    <div class="img-container">
                        <?php
                        echo '<img class="img-styling" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                        ?>
                    </div>
                    <div class="title-styling">
                        Reviews
                    </div>
                    <?php
                        if(!empty($checkMember)){
                            echo <<< EOD
                                <div class="comment-content">
                                    <div class="comment-container">
                                        <input class="comment-styling" type="text" name="review" id="review">
                                        <input type="hidden" name="studEmail" value="{$email}">
                                        <input type="hidden" name="reviewedGame" value="{$gameID}">
                                        <button class="send-button" name="memberReview">SEND REVIEW</button>
                                    </div>
                                </div>
                            EOD;
                        }
                    ?>
                    <div class="divider"></div>
                    <div class="reviews-container">
                    <?php
                        if(empty($checkMember)){
                            if(empty($checkTestimonial)){
                                echo <<< EOD
                                    <div class="no-reviews">
                                        <div class="no-review-styling">No Board Game Reviews</div>
                                        <div class="no-review-desc">Become a member to leave a review</div>
                                    </div>
                                EOD;
                            }else{
                                foreach($checkTestimonial as $testimonial){
                                    $id = $testimonial['StudID'];
                                    $stud = StudentService::getStudentById($id);
                                    echo <<< EOD
                                        <div class="review-content">
                                            <div class="author-styling">
                                                {$stud->FirstName} {$stud->LastName}
                                            </div>
                                            <div class="subDivider"></div>
                                            <div class="testimony-review">
                                                {$testimonial['Statement']}
                                            </div>
                                        </div>
                                    EOD;
                                }
                            }
                        }else{
                            if(empty($checkTestimonial)){
                                echo <<< EOD
                                <div class="no-reviews">
                                    <div class="no-review-styling">No Board Game Reviews</div>
                                    <div class="no-review-desc">Share your experience</div>
                                </div> 
                                EOD;
                            }else{
                                foreach($checkTestimonial as $testimonial){
                                    
                                    $id = $testimonial['StudID'];
                                    $stud = StudentService::getStudentById($id);
                                    echo <<< EOD
                                        <div class="review-content">
                                            <div class="author-styling">
                                                {$stud->FirstName} {$stud->LastName}
                                            </div>
                                            <div class="subDivider"></div>
                                            <div class="testimony-review">
                                                {$testimonial['Statement']}
                                            </div>
                                        </div>
                                    EOD;
                                }
                            }
                        }               
                    ?>
                    </div>
                    <div class="divider"></div>
                </div>
            </form>
            <div class="right-column">
                <?php
                    echo <<< EOD
                        <div class="game-name-styling">
                            {$game->GameName}
                        </div>
                    EOD;
                ?>
                <div class="game-info">
                <?php
                    echo <<< EOD
                        <div class="category-styling">
                            {$game->GameCategory}
                        </div>
                    EOD;
                ?>
                <?php 
                //Modifying Rent price for member and non-member
                    if(empty($checkMember)){
                        //for non-member
                        echo <<< EOD
                            <div class="info-styling">
                            Rent Price: <span class="value-styling">₱100.00</span>
                            </div> 
                        EOD;
                    }else{
                        //for member
                        echo <<< EOD
                            <div class="info-styling">
                            Rent Price: <span class="value-styling">No Charge</span>
                            </div> 
                        EOD;
                    }
                ?>
                    <div class="rating-styling">
                        Game Rating: 
                        <span class="value-styling">
                            <?php 
                                if(!empty($checkTestimonial)){
                                    $totalRating = 0;
                                    foreach($checkTestimonial as $testimonial){
                                        $totalRating = $totalRating + $testimonial['Rating'];
                                    }
                                    $totalRating = $totalRating/count($checkTestimonial);
                                    echo " $totalRating/5";
                                }else{
                                    echo "No Rating";
                                }
                            ?>
                        </span>
                    </div>
                </div>
                <div class="title-styling">
                    Overview
                </div>
                <div class="divider"></div>
                <?php 
                    echo <<< EOD
                        <div class="text-content">
                            {$game->GameDescription}
                        </div>
                    EOD;
                ?>
                <div class="divider"></div>
                <div class="button-container">
                    <button class="button">RENT THIS GAME</button>
                    <button class="button">RESERVE THIS GAME</button>
                </div>
                <div class="back-button-container">
                    <button class="back-button">BACK</button>
                </div>
            </div>
        </div>
</body>
</html>