<?php

namespace App\Application\UseCases\Enrollment;

use App\Domain\Repositories\EnrollmentRepositoryInterface;

class CancelEnrollment
{
    public function __construct(private EnrollmentRepositoryInterface $repo) {}

    public function execute(int $id): void
    {
        $this->repo->delete($id);
    }
}