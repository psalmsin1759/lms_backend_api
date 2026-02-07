<?php

namespace App\Application\Services;

use App\Application\UseCases\Enrollment\EnrollUser;
use App\Application\UseCases\Enrollment\UpdateCompletionStatus;
use App\Application\UseCases\Enrollment\GetEnrollmentsByUser;
use App\Application\UseCases\Enrollment\GetEnrollmentsByCourse;
use App\Application\UseCases\Enrollment\CancelEnrollment;
use App\Domain\Entities\Enrollment;

class EnrollmentService
{
    public function __construct(
        private EnrollUser $enrollUser,
        private UpdateCompletionStatus $updateStatus,
        private GetEnrollmentsByUser $getByUser,
        private GetEnrollmentsByCourse $getByCourse,
        private CancelEnrollment $cancelEnrollment,
    ) {}

    public function enroll(array $data): Enrollment
    {
        return $this->enrollUser->execute($data['user_id'], $data['course_id']);
    }

    public function updateStatus(int $enrollmentId, string $status): Enrollment
    {
        return $this->updateStatus->execute($enrollmentId, \App\Enums\CompletionStatus::from($status));
    }

    public function getByUser(int $userId): array
    {
        return $this->getByUser->execute($userId);
    }

    public function getByCourse(int $courseId): array
    {
        return $this->getByCourse->execute($courseId);
    }

    public function cancel(int $id): void
    {
        $this->cancelEnrollment->execute($id);
    }
}
