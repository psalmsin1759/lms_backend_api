<?php

namespace App\Application\UseCases\Notification;

class SendBulkNotification
{
    public function __construct(
        private SendNotification $sendNotification
    ) {}

    public function execute(
        array $userIds,
        string $type,
        string $title,
        string $message
    ): void {
        foreach ($userIds as $userId) {
            $this->sendNotification->execute(
                $userId,
                $type,
                $title,
                $message
            );
        }
    }
}
