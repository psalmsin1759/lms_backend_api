<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\NotificationEntity;
use App\Domain\Repositories\NotificationRepositoryInterface;
use App\Models\Notification;
use Illuminate\Support\Collection;

class NotificationRepositoryImpl implements NotificationRepositoryInterface
{
    public function create(NotificationEntity $entity): NotificationEntity
    {
        $notification = Notification::create([
            'user_id' => $entity->userId,
            'type' => $entity->type,
            'title' => $entity->title,
            'message' => $entity->message,
            'read_at' => $entity->readAt,
        ]);

        return $this->toEntity($notification);
    }

    public function getUserNotifications(int $userId): Collection
    {
        return Notification::where('user_id', $userId)
            ->latest()
            ->get()
            ->map(fn ($n) => $this->toEntity($n));
    }

    public function getUnreadUserNotifications(int $userId): Collection
    {
        return Notification::where('user_id', $userId)
            ->whereNull('read_at')
            ->latest()
            ->get()
            ->map(fn ($n) => $this->toEntity($n));
    }

    public function findById(int $id): ?NotificationEntity
    {
        $notification = Notification::find($id);

        return $notification ? $this->toEntity($notification) : null;
    }

    public function markAsRead(int $notificationId): bool
    {
        return Notification::where('id', $notificationId)
            ->update(['read_at' => now()]) > 0;
    }

    public function markAllAsRead(int $userId): int
    {
        return Notification::where('user_id', $userId)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }

    public function delete(int $notificationId): bool
    {
        return Notification::where('id', $notificationId)->delete() > 0;
    }

    public function countUnread(int $userId): int
    {
        return Notification::where('user_id', $userId)
            ->whereNull('read_at')
            ->count();
    }

    /** Map Eloquent → Entity */
    private function toEntity(Notification $notification): NotificationEntity
    {
        return new NotificationEntity(
            id: $notification->id,
            userId: $notification->user_id,
            type: $notification->type,
            title: $notification->title,
            message: $notification->message,
            readAt: $notification->read_at,
            createdAt: $notification->created_at
        );
    }
}
