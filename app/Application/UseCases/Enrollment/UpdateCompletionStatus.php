<?php

namespace App\Application\UseCases\Enrollment;

use App\Domain\Entities\Enrollment;
use App\Domain\Repositories\EnrollmentRepositoryInterface;
use App\Enums\CompletionStatus;
use App\Exceptions\ApiException;

class UpdateCompletionStatus
{
    public function __construct(private EnrollmentRepositoryInterface $repo) {}

    public function execute(int $enrollmentId, CompletionStatus $status): Enrollment
    {
        $enrollment = $this->repo->findById($enrollmentId);
        if (!$enrollment) throw new ApiException('Enrollment not found');

        $enrollment->completionStatus = $status;
        $enrollment->completionDate = $status === CompletionStatus::COMPLETED ? new \DateTime() : null;

        return $this->repo->update($enrollment);
    }
}
