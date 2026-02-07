<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Enrollment;

interface EnrollmentRepositoryInterface
{
    public function create(Enrollment $enrollment): Enrollment;
    public function update(Enrollment $enrollment): Enrollment;
    public function delete(int $id): void;
    public function findById(int $id): ?Enrollment;
    public function findByUserAndCourse(int $userId, int $courseId): ?Enrollment;
    public function getByUser(int $userId): array;
    public function getByCourse(int $courseId): array;
}
