<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Board Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- Include Header and Footer-->
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>

    <!-- Front End start -->
    <form action="admin-add_board_game.php" method="POST" enctype="multipart/form-data">
        <!--Board Game Name-->
        <label for="game_name">Board Game Name</label>
        <input type="text" name="game_name" id="game_name">

        <!--Board Game Image-->
        <label for="game_img">Board Game Image</label>
        <input type="file" id="game_img" name="game_img" class="form-control" onchange="onFileSelected(event)" style="height: 45px;" accept="image/*">

        <!--Description-->
        <label for="game_desc">Description</label><br>
        <textarea type="text" name="description" id="description" required class="form-control" style="height: 300px;" ></textarea>

        <!--Category-->
        <label for="game_category">Category</label>
        <input type="text" name="game_category" id="game_category">

        <!--Quantity Available-->
        <label for="quantity_avail">Quantity Available</label>
        <input type="number" name="quantity_avail" id="quantity_avail">

        <!--Submit Button-->
        <input type="submit">
    </form>

    <!-- Backend Start -->
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $game_image = file_get_contents($_FILES['game_img']['tmp_name']); //event image
        $image_encoded = base64_encode($game_image);
        $status = "Available"; //by default available

        $boardgame = new BoardGame();

        $boardgame->GameName = $_POST['game_name'];
        $boardgame->GameDescription = $_POST['description'];
        $boardgame->GameImage = $image_encoded;
        $boardgame->QuantityAvailable = $_POST['quantity_avail'];
        $boardgame->GameCategory = $_POST['game_category'];
        $boardgame->GameStatus = $status;
        
        BoardGameService::addNewBoardGame($boardgame);
    }
    ?>

    
    
</body>
</html>
