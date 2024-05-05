<?php

class Notification
{
    public int $NotificationID;
    public string $NotificationTitle;
    public string $NotificationBody;
    public string $TargetEmail;
    public string $CreatedAt;

    function __construct() {}
}

?>