<?php

namespace App\Application\UseCases\Course;

use App\Domain\Repositories\CourseRepositoryInterface;
use RuntimeException;

class DeleteCourse
{
    public function __construct(private CourseRepositoryInterface $courseRepo) {}

    public function execute(int $id): void
    {
        $this->courseRepo->delete($id);
    }
}
