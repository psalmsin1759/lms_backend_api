<?php

namespace App\Application\UseCases\Enrollment;

use App\Domain\Entities\Enrollment;
use App\Domain\Repositories\EnrollmentRepositoryInterface;
use App\Enums\CompletionStatus;
use App\Exceptions\ApiException;

class EnrollUser
{
    public function __construct(private EnrollmentRepositoryInterface $repo) {}

    public function execute(int $userId, int $courseId): Enrollment
    {
        $existing = $this->repo->findByUserAndCourse($userId, $courseId);
        if ($existing) throw new ApiException('User already enrolled');

        $enrollment = new Enrollment(
            id: null,
            userId: $userId,
            courseId: $courseId,
            enrolledAt: new \DateTime(),
            completionStatus: CompletionStatus::IN_PROGRESS,
        );

        return $this->repo->create($enrollment);
    }
}