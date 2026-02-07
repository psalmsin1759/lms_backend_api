<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Lesson;

interface LessonRepositoryInterface
{
    public function create(Lesson $lesson): Lesson;

    public function update(Lesson $lesson): Lesson;

    public function delete(int $id): void;

    public function findById(int $id): ?Lesson;

    public function findByModule(int $moduleId): array;


}
