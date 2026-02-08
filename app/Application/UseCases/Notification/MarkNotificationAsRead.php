<?php

namespace App\Application\UseCases\Notification;

use App\Domain\Repositories\NotificationRepositoryInterface;

class MarkNotificationAsRead
{
    public function __construct(
        private NotificationRepositoryInterface $repository
    ) {}

    public function execute(int $notificationId): void
    {
        $notification = $this->repository->findById($notificationId);
        $notification->markAsRead();

        $this->repository->create($notification);
    }
}
