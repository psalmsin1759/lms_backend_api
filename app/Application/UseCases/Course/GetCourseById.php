<?php

namespace App\Application\UseCases\Course;

use App\Domain\Entities\Course;
use App\Domain\Repositories\CourseRepositoryInterface;
use App\Exceptions\ApiException;
use RuntimeException;

class GetCourseById
{
    public function __construct(private CourseRepositoryInterface $courseRepo) {}

    public function execute(int $id): Course
    {
        $course = $this->courseRepo->findById($id);
        if (!$course) {
            throw new ApiException('Course not found');
        }

        return $course;
    }
}
