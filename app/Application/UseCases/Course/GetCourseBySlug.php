<?php

namespace App\Application\UseCases\Course;

use App\Domain\Entities\Course;
use App\Domain\Repositories\CourseRepositoryInterface;
use App\Exceptions\ApiException;
use RuntimeException;

class GetCourseBySlug
{
    public function __construct(private CourseRepositoryInterface $courseRepo) {}

    public function execute(string $slug): Course
    {
        $course = $this->courseRepo->findBySlug($slug);
        if (!$course) {
            throw new ApiException('Course not found');
        }

        return $course;
    }
}
