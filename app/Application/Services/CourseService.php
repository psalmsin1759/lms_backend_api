<?php

namespace App\Application\Services;

use App\Domain\Entities\Course;
use App\Enums\CourseStatus;
use App\Application\UseCases\Course\CreateCourse;
use App\Application\UseCases\Course\UpdateCourse;
use App\Application\UseCases\Course\DeleteCourse;
use App\Application\UseCases\Course\GetCourseById;
use App\Application\UseCases\Course\GetCoursesByInstructor;
use App\Application\UseCases\Course\ChangeCourseStatus;
use App\Application\UseCases\Course\GetCourseBySlug;
use App\Application\UseCases\Course\GetCourses;

class CourseService
{
    public function __construct(
        private CreateCourse $createCourse,
        private UpdateCourse $updateCourse,
        private DeleteCourse $deleteCourse,
        private GetCourseById $getCourseById,
        private GetCourses $getCourses,
        private GetCoursesByInstructor $getCoursesByInstructor,
        private ChangeCourseStatus $changeCourseStatus,
        private GetCourseBySlug $getCourseBySlug
    ) {}

    /**
     * Create a new course
     */
    public function create(array $data): Course
    {
        return $this->createCourse->execute($data);
    }

    /**
     * Update an existing course
     */
    public function update(array $data): Course
    {
        return $this->updateCourse->execute($data);
    }

    /**
     * Delete a course
     */
    public function delete(int $id): void
    {
        $this->deleteCourse->execute($id);
    }

    /**
     * Get single course by ID
     */
    public function findById(int $id): Course
    {
        return $this->getCourseById->execute($id);
    }

    public function findBySlug(string $slug): Course
    {
        return $this->getCourseBySlug->execute($slug);
    }

    public function findByInstructor(int $instructorId): array
    {
        return $this->getCoursesByInstructor->execute($instructorId);
    }

    /**
     * List courses with pagination, filters & ordering
     *
     * Supported filters:
     * - search
     * - status
     * - level
     * - instructor_id
     * - page
     * - per_page
     * - order_by
     * - order_dir
     */
    public function list(array $filters = []): array
    {
        return $this->getCourses->execute($filters);
    }

    /**
     * Get courses by instructor
     */
    public function getByInstructor(int $instructorId): array
    {
        return $this->getCoursesByInstructor->execute($instructorId);
    }

    /**
     * Change course status (draft, published, archived)
     */
    public function changeStatus(int $id, CourseStatus $status): Course
    {
        return $this->changeCourseStatus->execute($id, $status);
    }
}
