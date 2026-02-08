<?php

namespace App\Application\UseCases\Notification;

use App\Domain\Repositories\NotificationRepositoryInterface;

class MarkAllNotificationsAsRead
{
    public function __construct(
        private NotificationRepositoryInterface $repository
    ) {}

    public function execute(int $userId): void
    {
        $this->repository->markAllAsRead($userId);
    }
}
