<?php

namespace App\Application\Services;

use App\Domain\Entities\Module;
use App\Application\UseCases\Course\Module\CreateModule;
use App\Application\UseCases\Course\Module\UpdateModule;
use App\Application\UseCases\Course\Module\DeleteModule;
use App\Application\UseCases\Course\Module\GetModulesByCourse;
use App\Application\UseCases\Course\Module\GetModuleById;

class ModuleService
{
    public function __construct(
        private CreateModule $createModule,
        private UpdateModule $updateModule,
        private DeleteModule $deleteModule,
        private GetModuleById $getModuleById,
        private GetModulesByCourse $getModulesByCourse
    ) {}

    /**
     * Create a new module
     */
    public function create(array $data): Module
    {
        return $this->createModule->execute($data);
    }

    /**
     * Update an existing module
     */
    public function update(array $data): Module
    {
        return $this->updateModule->execute($data);
    }

    /**
     * Delete a module by ID
     */
    public function delete(int $id): void
    {
        $this->deleteModule->execute($id);
    }

    /**
     * Get a module by ID
     */
    public function findById(int $id): Module
    {
        return $this->getModuleById->execute($id);
    }

    /**
     * Get all modules for a specific course
     */
    public function getByCourse(int $courseId): array
    {
        return $this->getModulesByCourse->execute($courseId);
    }

    
}
