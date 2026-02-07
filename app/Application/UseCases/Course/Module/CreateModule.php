<?php

namespace App\Application\UseCases\Course\Module;

use App\Domain\Entities\Module;
use App\Domain\Repositories\ModuleRepositoryInterface;

class CreateModule
{
    public function __construct(private ModuleRepositoryInterface $moduleRepo) {}

    public function execute(array $data): Module
    {
        $module = new Module(
            id: null,
            courseId: $data['course_id'],
            title: $data['title'],
            order: $data['order'] ?? 0
        );

        return $this->moduleRepo->create($module);
    }
}
