<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Module;

interface ModuleRepositoryInterface
{
    public function create(Module $module): Module;
    public function update(Module $module): Module;
    public function findById(int $id): ?Module;
    public function findByCourseId(int $courseId): array;
    public function delete(int $id): void;
    public function all(): array;
}
