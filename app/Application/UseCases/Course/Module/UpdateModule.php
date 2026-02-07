<?php

namespace App\Application\UseCases\Course\Module;

use App\Domain\Entities\Module;
use App\Domain\Repositories\ModuleRepositoryInterface;
use App\Exceptions\ApiException;

class UpdateModule
{
    public function __construct(private ModuleRepositoryInterface $moduleRepo) {}

    public function execute(array $data): Module
    {
        $module = $this->moduleRepo->findById($data['id']);
        if (!$module) {
            throw new ApiException('Module not found');
        }

        $module->title = $data['title'] ?? $module->title;
        $module->order = $data['order'] ?? $module->order;

        return $this->moduleRepo->update($module);
    }
}
