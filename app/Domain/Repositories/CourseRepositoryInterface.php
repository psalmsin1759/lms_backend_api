<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Course;
use App\Enums\CourseStatus;
use App\Enums\CourseLevel;

interface CourseRepositoryInterface
{
   
    public function create(Course $course): Course;

   
    public function update(Course $course): Course;

   
    public function delete(int $id): void;

    
    public function findById(int $id): ?Course;

    public function findBySlug(string $slug): ?Course;

    public function all(): array;

    public function getByInstructor(int $instructorId): array;

 
    public function changeStatus(int $id, CourseStatus $status): Course;


   public function paginate(
        int $perPage = 15,
        int $page = 1,
        ?string $search = null,
        ?string $status = null,
        ?string $level = null,
        ?int $instructorId = null,
        string $orderBy = 'created_at',
        string $orderDir = 'desc'
    ): array;

}
