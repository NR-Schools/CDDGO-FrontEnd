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
    <style>
    </style>
</head>
<body>
    <!-- Include Header and Footer-->
    <?php 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/header.php"; 
        require_once $_SERVER['DOCUMENT_ROOT'] . "/components/footer.php";
    ?>

    <!-- Front End start -->
    <div class= "page-container">
        <div class="add-board-title">
            ADD BOARD GAME
        </div>
        <form action="admin-add_board_game.php" method="POST" enctype="multipart/form-data">
            <!--Board Game Name-->
            <label for="game_name">Board Game Name</label>
            <input type="text" name="game_name" id="game_name">

            <!--Board Game Image-->
            <label for="game_img">Board Game Image</label>
            <input type="file" id="game_img" name="game_img" class="form-control" onchange="onFileSelected(event)" style="height: 45px;" accept="image/*">

            <!--Description-->
            <label for="game_desc">Description</label><br>
            <textarea type="text" name="description" id="description" class="form-control" style="height: 200px;" ></textarea>

            <!--Category-->
            <label for="game_category">Category</label>
            <select name="game_category">
                <option value="No Category">Select Category</option>
                <option value="Abstract Strategy">Abstract Strategy</option>
                <option value="Area Control">Area Control</option>
                <option value="Campaign">Campaign</option>
                <option value="City Building">City Building</option>
                <option value="Cooperative">Cooperative</option>
                <option value="Deck Building">Deck Building</option>
                <option value="Deduction">Deduction</option>
                <option value="Dexterity">Dexterity</option>
                <option value="Dungeon Crawler">Dungeon Crawler</option>
                <option value="Economic">Economic</option>
                <option value="Family">Family</option>
                <option value="Fighting">Fighting</option>
                <option value="Hand Management">Hand Management</option>
                <option value="Kid">Kid</option>
                <option value="Limited Communication">Limited Communication</option>
                <option value="Party">Party</option>
                <option value="Pick-Up and Deliver">Pick-Up and Deliver</option>
                <option value="Programming">Programming</option>
                <option value="Set Collection">Set Collection</option>
                <option value="Storytelling">Storytelling</option>
                <option value="Tower Defense">Tower Defense</option>
                <option value="War">War</option>
                <option value="Word">Word</option>
                <option value="Worker Placement">Worker Placement</option>
            </select>

            <!--Quantity Available-->
            <label for="quantity_avail">Quantity Available</label>
            <input type="number" name="quantity_avail" id="quantity_avail">

            <!--Submit Button-->
            <button type="submit">Add Board Game</button>
        </form>

        <!--Cancel Button-->
        <a href="admin-manage_board_games.php">
            <button>Cancel</button>
        </a>
    </div>

    <!-- Backend Start -->
    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //image
        $game_image = file_get_contents($_FILES['game_img']['tmp_name']); //event image
        $image_encoded = base64_encode($game_image);

        //status
        $status = "Available"; //by default available

        //create board games 
        $boardgame = new BoardGame();

        $boardgame->GameName = $_POST['game_name'];
        $boardgame->GameDescription = $_POST['description'];
        $boardgame->GameImage = $image_encoded;
        $boardgame->QuantityAvailable = $_POST['quantity_avail'];
        $boardgame->GameCategory = $_POST['game_category'];
        $boardgame->GameStatus = $status;
        
        try{
            BoardGameService::addNewBoardGame($boardgame);

            echo "<script> alert('Board Game Added');
            document.location.href = 'admin-manage_board_games.php';
            </script>";
        }

        catch (PDOExceptionException $e){
            echo $e->getMessage();
            echo "<script>
            alert('Failed to add BoardGame');
            document.location.href = 'admin-add_board_game.php';
            </script>
            ";

        }
    }
    ?>

    
    
</body>
</html>
