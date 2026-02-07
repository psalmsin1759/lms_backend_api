<?php

namespace App\Application\UseCases\Course;

use App\Domain\Entities\Course;
use App\Domain\Repositories\CourseRepositoryInterface;

class GetCoursesByInstructor
{
    public function __construct(private CourseRepositoryInterface $courseRepo) {}

    public function execute(int $instructorId): array
    {
        return $this->courseRepo->getByInstructor($instructorId);
    }
}
