<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\NotificationEntity;
use Illuminate\Support\Collection;

interface NotificationRepositoryInterface
{
   
    public function create(NotificationEntity $entity): NotificationEntity;

  
    public function getUserNotifications(int $userId): Collection;

    public function getUnreadUserNotifications(int $userId): Collection;

   
    public function findById(int $id): ?NotificationEntity;

  
    public function markAsRead(int $notificationId): bool;

   
    public function markAllAsRead(int $userId): int;

  
    public function delete(int $notificationId): bool;

   
    public function countUnread(int $userId): int;
}
