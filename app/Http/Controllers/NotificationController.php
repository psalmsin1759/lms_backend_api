<?php

namespace App\Http\Controllers;

use App\Application\Services\NotificationService;
use App\Http\Requests\Notification\SendNotificationRequest;
use App\Http\Requests\Notification\SendBulkNotificationRequest;
use App\Utils\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct(
        private NotificationService $service
    ) {}

    /**
     * Get authenticated user's notifications
     */
    public function index($id): JsonResponse
    {
        $notifications = $this->service->getUserNotifications($id);

        return ApiResponse::success(
            $notifications,
            'Notifications retrieved successfully'
        );
    }

    /**
     * Send notification to a single user
     */
    public function store(SendNotificationRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->service->sendNotification(
            userId: $data['user_id'],
            message: $data['message'],
            type: $data['type'] ?? 'info',
            title: $data['title'] ?? 'Notification'
        );

        return ApiResponse::success(
            null,
            'Notification sent successfully',
            201
        );
    }

    /**
     * Send notification to multiple users
     */
    public function bulk(SendBulkNotificationRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->service->sendBulkNotification(
            userIds: $data['user_ids'],
            type: $data['type'] ?? 'info',
            title: $data['title'] ?? 'Notification',
            message: $data['message']
        );

        return ApiResponse::success(
            null,
            'Bulk notifications sent successfully',
            201
        );
    }

    /**
     * Mark a single notification as read
     */
    public function markAsRead(int $id): JsonResponse
    {
        $this->service->markAsRead($id);

        return ApiResponse::success(
            null,
            'Notification marked as read'
        );
    }

    /**
     * Mark all notifications as read for user
     */
    public function markAllAsRead(int $id): JsonResponse
    {
        $this->service->markAllNotificationsAsRead($id);

        return ApiResponse::success(
            null,
            'All notifications marked as read'
        );
    }
}
