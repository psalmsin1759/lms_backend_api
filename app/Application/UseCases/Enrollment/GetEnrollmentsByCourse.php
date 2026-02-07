<?php

namespace App\Application\UseCases\Enrollment;

use App\Domain\Repositories\EnrollmentRepositoryInterface;

class GetEnrollmentsByCourse
{
    public function __construct(private EnrollmentRepositoryInterface $repo) {}

    public function execute(int $courseId): array
    {
        return $this->repo->getByCourse($courseId);
    }
}