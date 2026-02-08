<?php

namespace App\Application\Services;


use App\Application\UseCases\Notification\GetUserNotifications;
use App\Application\UseCases\Notification\MarkAllNotificationsAsRead;
use App\Application\UseCases\Notification\MarkNotificationAsRead;
use App\Application\UseCases\Notification\SendBulkNotification;
use App\Application\UseCases\Notification\SendNotification;

class NotificationService
{
    public function __construct(
       private GetUserNotifications $getUserNotifications,
       private MarkNotificationAsRead $markAsRead,
       private MarkAllNotificationsAsRead $markAllAsRead,
       private SendBulkNotification $sendBulkNotification,
       private SendNotification $sendNotification,
    ) {}


    public function sendNotification(int $userId, string $message, string $type = 'info', string $title = 'Notification'): void
    {
        $this->sendNotification->execute($userId, $type, $title, $message);
    }

    public function sendBulkNotification(array $userIds, string $type = 'info', string $title = 'Notification', string $message): void
    {
        $this->sendBulkNotification->execute(
            userIds: $userIds,
            type: $type,
            title: $title,
            message: $message
        );
    }


    public function getUserNotifications(int $userId): array
    {
        return $this->getUserNotifications->execute($userId);
    }

    public function markNotificationsAsRead(int $userId): void
    {
        $this->markAllAsRead->execute($userId);
    }

    public function markAllNotificationsAsRead(int $userId): void
    {        
        $this->markAllAsRead->execute($userId);
    }



     /**
     * Send a notification to a user
     */
    /**
     * Mark a notification as read
     */
    public function markAsRead(int $notificationId): void
    {
        $this->markAsRead->execute($notificationId);
    }
}
