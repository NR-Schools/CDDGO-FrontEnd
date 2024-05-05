<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/repositories/NotificationRepository.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/NotificationModel.php';

class NotificationService
{
    static function addNewNotification(Notification $notification): bool
    {
        return NotificationRepository::addNotification($notification);
    }

    static function getAllNotificationsByEmail(string $email): array
    {
        // Get All Notifications
        $notifications = NotificationRepository::getNotificationsByTarget($email);

        // Delete Notifications
        NotificationRepository::deleteNotificationsByTarget($email);

        return $notifications;
    }
}

?>