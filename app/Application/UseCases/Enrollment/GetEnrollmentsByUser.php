<?php

namespace App\Application\UseCases\Enrollment;


use App\Domain\Repositories\EnrollmentRepositoryInterface;

class GetEnrollmentsByUser
{
    public function __construct(private EnrollmentRepositoryInterface $repo) {}

    public function execute(int $userId): array
    {
        return $this->repo->getByUser($userId);
    }
}
