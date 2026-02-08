<?php

namespace App\Domain\Entities;

use Carbon\Carbon;

class NotificationEntity
{
    public function __construct(
        public ?int $id,
        public int $userId,
        public string $type,
        public string $title,
        public string $message,
        public ?Carbon $readAt = null,
        public ?Carbon $createdAt = null
    ) {}

    /** Mark this notification as read */
    public function markAsRead(): void
    {
        $this->readAt = now();
    }

    /** Check if read */
    public function isRead(): bool
    {
        return $this->readAt !== null;
    }
}
