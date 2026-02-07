<?php

namespace App\Http\Controllers;

use App\Application\Services\EnrollmentService;
use App\Http\Requests\Enrollment\CreateEnrollmentRequest;
use App\Http\Requests\Enrollment\UpdateEnrollmentStatusRequest;
use App\Utils\ApiResponse;
use Illuminate\Http\JsonResponse;

class EnrollmentController extends Controller
{
    public function __construct(private EnrollmentService $service) {}

    public function indexByUser(int $userId): JsonResponse
    {
        $enrollments = $this->service->getByUser($userId);
        return ApiResponse::success($enrollments, 'Enrollments retrieved successfully');
    }

    public function indexByCourse(int $courseId): JsonResponse
    {
        $enrollments = $this->service->getByCourse($courseId);
        return ApiResponse::success($enrollments, 'Enrollments retrieved successfully');
    }

    public function show(int $id): JsonResponse
    {
        $enrollment = $this->service->getByUser($id);
        return ApiResponse::success($enrollment, 'Enrollment retrieved successfully');
    }

    public function store(CreateEnrollmentRequest $request): JsonResponse
    {
        $enrollment = $this->service->enroll($request->validated());
        return ApiResponse::success($enrollment, 'User enrolled successfully', 201);
    }

    public function updateStatus(UpdateEnrollmentStatusRequest $request, int $id): JsonResponse
    {
        $enrollment = $this->service->updateStatus($id, $request->validated()['completion_status']);
        return ApiResponse::success($enrollment, 'Enrollment status updated successfully');
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->cancel($id);
        return ApiResponse::success(null, 'Enrollment cancelled successfully');
    }
}
