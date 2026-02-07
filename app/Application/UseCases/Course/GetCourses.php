<?php

namespace App\Application\UseCases\Course;

use App\Domain\Repositories\CourseRepositoryInterface;

class GetCourses
{
    public function __construct(
        private CourseRepositoryInterface $courseRepo
    ) {}

    public function execute(array $filters = []): array
    {
        return $this->courseRepo->paginate(
            perPage: $filters['per_page'] ?? 15,
            page: $filters['page'] ?? 1,
            search: $filters['search'] ?? null,
            status: $filters['status'] ?? null,
            level: $filters['level'] ?? null,
            instructorId: $filters['instructor_id'] ?? null,
            orderBy: $filters['order_by'] ?? 'created_at',
            orderDir: $filters['order_dir'] ?? 'desc'
        );
    }
}
