<?php

namespace App\Application\UseCases\Notification;

use App\Domain\Repositories\NotificationRepositoryInterface;

class GetUserNotifications
{
    public function __construct(
        private NotificationRepositoryInterface $repository
    ) {}

    public function execute(int $userId): array
    {
        return $this->repository->getUserNotifications($userId)->toArray();
    }
}
