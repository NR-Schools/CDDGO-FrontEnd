<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/database/DatabaseConfig.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/NotificationModel.php';

class NotificationRepository
{
    static function addNotification(Notification $notification): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            INSERT INTO NOTIFICATIONS VALUES (null, :title, :body, :target, CURDATE());
            ",
            [
                ":title" => $notification->NotificationTitle,
                ":body" => $notification->NotificationBody,
                ":target" => $notification->TargetEmail
            ]
        );
    }

    static function getNotificationsByTarget(string $email): array
    {
        $queryResult = Database::SQLwithFetch(
            Database::getPDO(),
            "
            SELECT * FROM NOTIFICATIONS WHERE TargetEmail = :email;
            ",
            [
                ":email" => $email
            ]
        );

        $notifications = [];
        foreach ($queryResult as $notificationResult) {
            $notification = new Notification();
            $notification->NotificationID = $notificationResult['NotificationID'];
            $notification->NotificationTitle = $notificationResult['NotificationTitle'];
            $notification->NotificationBody = $notificationResult['NotificationBody'];
            $notification->TargetEmail = $notificationResult['TargetEmail'];
            $notification->CreatedAt = $notificationResult['CreatedAt'];

            $notifications[] = $notification;
        }

        return $notifications;
    }

    static function deleteNotificationsByTarget(string $email): bool
    {
        return Database::SQLwithoutFetch(
            Database::getPDO(),
            "
            DELETE FROM NOTIFICATIONS WHERE TargetEmail = :email;
            ",
            [
                ":email" => $email
            ]
        );
    }
}

?>