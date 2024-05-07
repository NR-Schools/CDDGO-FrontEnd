<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");


    if (!AuthGuard::guard_route(Role::ADMIN)) {
        // Return to root
        header("Location: /");
    }


    //get All Board Games
    $games = BoardGameService::getAllBoardGames();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Board Games</title>
    <link type="text/css" rel="stylesheet" href="../css/user-board_games.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/admin-manage_board_games.css">

</head>
<body>
    <!-- Include Header and Footer-->
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>
    
    <!-- Start Board Game Cards -->
    <div class="main-body">
    <p>ALL BOARD GAMES</p>
        <hr />

        <a href="/templates/admin-add_board_game.php" class="btn btn-primary">Add New BoardGame</a>

    <div class="custom-layout-manager">

    <?php
        if($games != 0)
        {
            foreach($games as $game)
            {
                assert($game instanceof BoardGame);
                $editLink = "/templates/admin-edit_board_game.php?gameId=" . $game->GameID;
                $photoResource = 'data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage;
                echo <<<EOD
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{$photoResource}"  alt="{Card image}">
                    <div class="card-body">
                        <h5 class="card-title">{$game->GameName}</h5>
                        <p class="card-text">{$game->GameCategory}</p>
                        <p class="card-text">{$game->QuantityAvailable}</p>
                        <a href="$editLink" class="btn btn-primary">Edit Game</a>
                        <br />
                        <br />
                    </div>
                </div>
                EOD;
            }
        }
    ?>
    </div>
    </div>
</body>
</html>