<?php

namespace App\Application\UseCases\Course\Module;

use App\Domain\Repositories\ModuleRepositoryInterface;

class GetModulesByCourse
{
    public function __construct(private ModuleRepositoryInterface $moduleRepo) {}

    public function execute(int $courseId): array
    {
        return $this->moduleRepo->findByCourseId($courseId);
    }
}
