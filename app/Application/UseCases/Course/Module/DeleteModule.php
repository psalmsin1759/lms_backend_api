<?php

namespace App\Application\UseCases\Course\Module;

use App\Domain\Repositories\ModuleRepositoryInterface;
use App\Exceptions\ApiException;

class DeleteModule
{
    public function __construct(private ModuleRepositoryInterface $moduleRepo) {}

    public function execute(int $id): void
    {
        $module = $this->moduleRepo->findById($id);
        if (!$module) {
            throw new ApiException('Module not found');
        }

        $this->moduleRepo->delete($id);
    }
}
