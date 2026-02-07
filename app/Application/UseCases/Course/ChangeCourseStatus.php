<?php

namespace App\Application\UseCases\Course;

use App\Domain\Entities\Course;
use App\Domain\Repositories\CourseRepositoryInterface;
use App\Enums\CourseStatus;

class ChangeCourseStatus
{
    public function __construct(private CourseRepositoryInterface $courseRepo) {}

    public function execute(int $id, CourseStatus $status): Course
    {
        return $this->courseRepo->changeStatus($id, $status);
    }
}
