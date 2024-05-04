<?php

class BoardGame {
    public int $GameID;
    public string $GameName;
    public string $GameImage;
    public string $GameDescription;
    public int $QuantityAvailable;
    public string $GameCategory;
    public string $GameStatus;
    public float $GameRating;

    function __construct() {}
}

?>