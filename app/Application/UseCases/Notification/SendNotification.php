<?php

namespace App\Application\UseCases\Notification;

use App\Domain\Entities\NotificationEntity;
use App\Domain\Repositories\NotificationRepositoryInterface;

class SendNotification
{
    public function __construct(
        private NotificationRepositoryInterface $repository
    ) {}

    public function execute(
        int $userId,
        string $type,
        string $title,
        string $message
    ): NotificationEntity {
        $notification = new NotificationEntity(
            id: null,
            userId: $userId,
            type: $type,
            title: $title,
            message: $message,
            readAt: null
        );

        return $this->repository->create($notification);
    }
}
