<?php

namespace App\Application\UseCases\Course\Module;

use App\Domain\Entities\Module;
use App\Domain\Repositories\ModuleRepositoryInterface;
use App\Exceptions\ApiException;

class GetModuleById
{
    public function __construct(private ModuleRepositoryInterface $moduleRepo) {}

    public function execute(int $id): Module
    {
        $module = $this->moduleRepo->findById($id);
        if (!$module) {
            throw new ApiException('Module not found');
        }

        return $module;
    }
}
