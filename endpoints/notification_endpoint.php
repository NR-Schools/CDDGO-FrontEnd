<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/services/AuthService.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/services/NotificationService.php';

class NotificationDTO
{
    public bool $status;
    public string $error_msg;
    public array $notifications;
    
    function __construct() {}

    static function create(): NotificationDTO
    {
        return new NotificationDTO();
    }

    function setStatus(bool $status): NotificationDTO
    {
        $this->status = $status;
        return $this;
    }

    function setErrorMessage(string $error_msg): NotificationDTO
    {
        $this->error_msg = $error_msg;
        return $this;
    }

    function setNotifications(array $notifications): NotificationDTO
    {
        $this->notifications = $notifications;
        return $this;
    }

    function build(): string
    {
        return json_encode($this);
    }
}


// Check if signed-in
[$email, $role] = AuthService::getCurrentlyLoggedIn();
if ($email == null)
{
    echo NotificationDTO::create()
                        ->setStatus(false)
                        ->setErrorMessage("No Logged In User")
                        ->setNotifications([])
                        ->build();
}
else {
    // Return Notifications
    echo NotificationDTO::create()
                        ->setStatus(true)
                        ->setErrorMessage("None")
                        ->setNotifications(
                            NotificationService::getAllNotificationsByEmail($email)
                        )
                        ->build();
}

?>