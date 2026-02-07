<?php

namespace App\Application\UseCases\Course;

use App\Domain\Entities\Course;
use App\Domain\Repositories\CourseRepositoryInterface;
use App\Exceptions\ApiException;
use Illuminate\Support\Str;
use RuntimeException;

class UpdateCourse
{
    public function __construct(private CourseRepositoryInterface $courseRepo) {}

    public function execute(array $data): Course
    {
        $course = $this->courseRepo->findById($data['id']);
        if (!$course) {
            throw new ApiException("Course not found");
        }

        $updatedCourse = new Course(
            id: $course->id,
            title: $data['title'] ?? $course->title,
            description: $data['description'] ?? $course->description,
            slug: Str::slug($data["title"]) ?? $course->slug,
            instructorId: $data['instructor_id'] ?? $course->instructorId,
            level: $data['level'] ?? $course->level,
            duration: $data['duration'] ?? $course->duration,
            price: $data['price'] ?? $course->price,
            status: $data['status'] ?? $course->status
        );

        return $this->courseRepo->update($updatedCourse);
    }
}