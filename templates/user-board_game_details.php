<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/services/BoardGameService.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/guards/AuthGuard.php");

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
            <div class="left-column">
                <div class="img-container">
                    <img class="img-styling" src="../assets/img-placeholder.png" alt="">
                </div>
                <div class="title-styling">
                    Reviews
                </div>
                <div class="divider"></div>
                <div class="reviews-container">
                    <div class="review-content">
                        <div class="author-styling">
                            Author (<span>Position</span>)
                        </div>
                        <div class="subDivider"></div>
                        <div class="testimony-review">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis ratione amet iusto error aperiam ut rem alias, illo quam, fugit odio provident sequi! Iusto non blanditiis omnis perspiciatis, laborum sunt alias consectetur sint vitae et illo illum laboriosam similique, aliquam odio reiciendis ratione, aperiam excepturi nostrum? Deserunt, sed aliquid. Repudiandae eveniet quisquam necessitatibus accusantium dolores id in pariatur nisi, doloremque maxime. Eos est ut praesentium nisi ex incidunt sunt tempora quos aliquam similique, deserunt rem debitis, reiciendis hic voluptatibus omnis cumque ipsa sint, earum tempore! Maiores, saepe reiciendis impedit harum nobis deserunt cupiditate laborum, illum temporibus voluptates qui nulla praesentium!
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
            </div>
            <div class="right-column">
                <div class="game-name-styling">
                    Board Game Name
                </div>
                <div class="game-info">
                    <div class="category-styling">
                        Category
                    </div>
                    <div class="info-styling">
                        Rent Price: <span class="value-styling">₱100.00</span>
                    </div>
                    <div class="rating-styling">
                        Game Rating: <span class="value-styling">5.0</span>
                    </div>
                </div>
                <div class="title-styling">
                    Overview
                </div>
                <div class="divider"></div>
                <div class="text-content">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempora vel rem aspernatur architecto nisi fugit, iure id temporibus minima libero. Velit dolor, nam sint, recusandae sed doloremque minus error dolores dolorem ea, fugiat voluptate repellat. Ipsum, dolor recusandae. Dolorum a modi ipsam, veritatis eos distinctio laboriosam est quas quasi. Repellat autem eaque commodi numquam. Minus quisquam nulla architecto dolorem quibusdam modi aliquid doloremque, veritatis recusandae unde commodi voluptatibus deleniti, accusantium fugiat reiciendis blanditiis, aut ex? Neque minus dignissimos dolore reprehenderit quas harum doloribus. Dolorum quas, quo adipisci mollitia quod quam reiciendis blanditiis ratione nostrum vero magnam obcaecati sapiente, numquam harum cupiditate suscipit quidem? Mollitia suscipit quasi nostrum fugiat itaque nesciunt velit doloremque iste facilis neque, odit sed rerum, officiis expedita vel nobis quos ratione eligendi in, ipsum reiciendis nisi. Veniam debitis, quam hic earum inventore reiciendis neque nemo aperiam commodi veritatis id cumque ullam impedit vel repellat ipsam similique voluptate quae expedita! Laborum nisi vel modi accusamus deleniti nobis voluptate, odio, ipsa iste aliquam perferendis delectus doloribus dolore ea maiores possimus aut voluptates esse molestiae. Possimus magnam nam sit voluptate laudantium est deserunt? Quia dolores asperiores velit, nobis maiores blanditiis accusantium molestiae distinctio ullam, expedita illum impedit ipsum facilis beatae tempore magni voluptates error ducimus ipsa! Repellendus quo dolore, officia possimus dignissimos ea quos modi optio ratione corporis incidunt, obcaecati illum nemo adipisci debitis rem! Ea quae esse accusamus, deleniti incidunt earum omnis maxime, perspiciatis provident minima error sed ut cum cupiditate voluptatem eaque quaerat temporibus molestias assumenda officia ratione. Possimus eos voluptatum, numquam, sit omnis temporibus soluta sequi sapiente ipsa dicta cumque aliquid fugit perspiciatis maiores! Quibusdam minus porro possimus, facere rem nostrum quae odit. Facilis minus qui, quasi sit impedit ratione doloribus aperiam veniam? Tempore, iste! Accusamus repellendus doloribus cumque, eaque voluptate quis aperiam sunt amet delectus eveniet quas! Accusamus, eaque est. Qui quos nam iste sed! Possimus, temporibus earum? Mollitia harum ut voluptate eveniet repudiandae magni incidunt est. Quam mollitia dignissimos ipsum deserunt et numquam libero soluta reiciendis praesentium autem error, dolorem fugit accusamus voluptatem dolor expedita sit rerum voluptates, voluptatum maiores! Quia at tempora labore nihil quae neque, magnam ducimus sit rem possimus consequuntur. Dolorum consequuntur fugit ipsum repellat, harum natus. Deserunt ducimus aliquid quam pariatur unde dolores vero ex cupiditate delectus praesentium, provident atque, sunt alias officiis rem quisquam impedit nemo veritatis molestiae. Asperiores impedit illum, magni, nesciunt maxime, id exercitationem consectetur blanditiis sapiente distinctio consequuntur! Aliquam deleniti, numquam dolorum, alias ex harum amet maxime aliquid aspernatur obcaecati a vel laudantium soluta unde. Id, ullam voluptatem consequuntur at autem officia libero ut labore culpa aut, provident sed dolorum, vero officiis rem dolores est debitis beatae quam! Ipsum magnam voluptas dolor praesentium, doloremque dicta, quas minus dolorem commodi quia id? Voluptatem, itaque hic nobis nam fugiat velit voluptatum eaque maxime, repellat culpa maiores iure, quidem accusantium laudantium impedit ut? Earum voluptatem distinctio amet adipisci voluptate totam laborum ut tempore voluptas hic laboriosam nostrum cupiditate accusantium officiis tempora magni velit eius, maiores similique? Adipisci cum cupiditate officiis fugiat, dolorum, voluptatem suscipit blanditiis est quo voluptatibus corrupti qui! Praesentium voluptate vel tempora rem ea consectetur, quis reiciendis dolore libero quasi. Quas commodi sequi, harum expedita sed, quod ex odio doloremque officiis nisi nulla fugit iste nihil eius, quae veniam. Sed sit, voluptas facere neque est aliquam obcaecati, harum laborum dolorem nemo qui itaque exercitationem. Harum hic laudantium dolorum, odit repudiandae ullam fugiat tenetur ipsa impedit ad sed, ut voluptatum iure illum id aut quas nisi consectetur sint blanditiis, obcaecati et accusantium minima ex! Omnis, eum. Ea, placeat quibusdam, quas a suscipit voluptas voluptatem adipisci rem, harum itaque consequuntur tenetur. Et, est, sunt enim perspiciatis, assumenda recusandae velit amet iste dicta cum quasi tempore? Iste pariatur, ex aliquid saepe voluptas totam, natus ratione, magnam eius eveniet dolore maiores? Repellendus itaque earum perferendis soluta nemo, maxime nisi est aspernatur ipsa asperiores architecto rerum at ullam minus? Numquam soluta, voluptatibus pariatur veritatis illo quasi molestias quod. Quidem, voluptatem sunt consequatur maxime fugit ipsum quibusdam omnis nam iste repudiandae nisi consequuntur sequi earum praesentium ut ex? Quia nulla sit nemo, ipsa, consequatur omnis molestiae alias officiis odit voluptas qui quis magnam cupiditate? Animi soluta est quaerat nam perferendis a atque doloremque et! Aspernatur incidunt recusandae repudiandae consectetur? Possimus aut alias ab nihil soluta, modi at quos facilis eius veniam dolores sunt ad consectetur deserunt ullam? Amet asperiores consectetur officia voluptatum incidunt distinctio similique ea hic tempora odio ut saepe nam voluptatibus commodi iusto, veniam alias harum delectus tempore error earum omnis inventore quia. Reprehenderit debitis et nesciunt laborum dicta sequi dolor facere illum ullam, ipsa ea odio atque nemo labore qui ex perspiciatis voluptatibus exercitationem eius incidunt assumenda aliquid mollitia. Omnis non culpa optio, et sequi ipsa facere fugit architecto, hic sint, adipisci veniam odit ullam illo animi inventore tempora quisquam voluptatum a quibusdam? Tempore doloremque id voluptas ipsum dolor temporibus voluptate assumenda accusantium ducimus nihil quasi et expedita facere repellendus, consequuntur laudantium deserunt soluta ratione iusto vero dolore vel. Corporis rerum, sequi, ab in voluptatum vel possimus totam quibusdam iste a expedita neque, eius recusandae numquam iure culpa libero. Id voluptate explicabo possimus quibusdam dolore distinctio provident voluptatem architecto corrupti, quae deleniti sit eligendi vero, consequatur corporis fuga animi officia ipsum dignissimos quaerat quisquam enim. Inventore rem magni repudiandae necessitatibus blanditiis mollitia hic accusamus. Eaque temporibus unde earum sed laboriosam ab commodi pariatur fugiat dolores quae eum corrupti nisi, cum magnam. Harum, totam ratione! Iste facilis aliquid natus consequuntur velit aut omnis ducimus nobis. Ipsa asperiores, natus hic, ipsum perspiciatis illo earum numquam dignissimos vitae quia et doloremque omnis libero error voluptatibus expedita assumenda nostrum, tempore ad nesciunt soluta consequuntur laboriosam sed quos! Fugiat reprehenderit quidem vitae est rem odit ipsa rerum quod incidunt optio, doloremque tempora, quasi tempore earum culpa deleniti exercitationem? Dolor error mollitia nam expedita iusto, voluptatibus, maxime odit, minus possimus temporibus ex. Quasi, a asperiores numquam sapiente mollitia quos provident vitae natus totam est reiciendis incidunt eveniet repudiandae, aut dolor, dolores recusandae cum nesciunt eum quibusdam magnam?
                </div>
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










        <!--
        <div class="content-container">
            <?php
                        // Output events for the found game
                        echo '<div class="game-card" style="padding:0">';
                        echo '<img class="game-card-pic" style="height:300px;min-width:300" src="data:image/' . pathinfo($game->GameImage, PATHINFO_EXTENSION) . ';base64,' . $game->GameImage . '" id="game_image">';
                        echo '<div class="game-card-body">';
                        echo '<h4 class="game-card-title">' . $game->GameName . '</h4>';
                        echo '<p class="game-card-text">' . $game->GameCategory . '</p>';
                        echo '<p class="game-card-text"> Quantity Available: ' . $game->QuantityAvailable . '</p>';
                        echo '<p class="game-card-text"> Overview: ' . $game->GameDescription . '</p>';
                        echo '<a href="/templates/user-board_game_details.php?gameId=' . $game->GameID . '" class="game-btn">Rent</a>';
                        echo '<a href="/templates/user-reservation_details.php?gameId=' . $game->GameID . '" class="game-btn">Reserve</a>';
                        echo '<a href="/templates/user-board_game_details.php?gameId=' . $game->GameID . '" class="game-btn">Back</a>';
                        echo '</div>';
                        echo '</div>';
            ?>
        </div>
        -->
        
</body>
</html>