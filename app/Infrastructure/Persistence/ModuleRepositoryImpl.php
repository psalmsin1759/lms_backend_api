<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Module;
use App\Domain\Repositories\ModuleRepositoryInterface;
use App\Exceptions\ApiException;
use App\Models\Module as ModuleModel;


class ModuleRepositoryImpl implements ModuleRepositoryInterface
{
    public function create(Module $module): Module
    {
        $model = ModuleModel::create([
            'course_id' => $module->courseId,
            'title'     => $module->title,
            'order'     => $module->order,
        ]);

        return $this->toEntity($model);
    }

    public function update(Module $module): Module
    {
        $model = ModuleModel::find($module->id);

        if (!$model) {
            throw new ApiException('Module not found');
        }

        $model->update([
            'title' => $module->title,
            'order' => $module->order,
        ]);

        return $this->toEntity($model);
    }

    public function findById(int $id): ?Module
    {
        $model = ModuleModel::find($id);
        return $model ? $this->toEntity($model) : null;
    }

    public function findByCourseId(int $courseId): array
    {
        return ModuleModel::where('course_id', $courseId)
            ->orderBy('order')
            ->get()
            ->map(fn($model) => $this->toEntity($model))
            ->toArray();
    }

    public function delete(int $id): void
    {
        $model = ModuleModel::find($id);
        if (!$model) {
            throw new ApiException('Module not found');
        }

        $model->delete();
    }

    public function all(): array
    {
        return ModuleModel::all()
            ->map(fn($model) => $this->toEntity($model))
            ->toArray();
    }

    /**
     * Convert Eloquent model to Domain Entity
     */
    private function toEntity(ModuleModel $model): Module
    {
        return new Module(
            id: $model->id,
            courseId: $model->course_id,
            title: $model->title,
            order: $model->order,
        );
    }

}
