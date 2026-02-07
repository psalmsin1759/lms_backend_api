<?php

namespace App\Application\UseCases\Course;

use App\Domain\Entities\Course;
use App\Domain\Repositories\CourseRepositoryInterface;
use App\Enums\CourseLevel;
use App\Enums\CourseStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateCourse
{
    public function __construct(
        private CourseRepositoryInterface $courseRepo
    ) {}

    public function execute(array $data): Course
    {
        $course = new Course(
            id: null,
            instructorId: Auth::id(),
            title: $data['title'],
            description: $data['description'] ?? null,
            slug: Str::slug($data["title"]),
            level: isset($data['level'])
                ? CourseLevel::from($data['level'])
                : CourseLevel::BEGINNER,

            duration: $data['duration'] ?? 0,

            price: $data['price'] ?? 0.0,

            status: CourseStatus::DRAFT,
        );

        return $this->courseRepo->create($course);
    }
}
