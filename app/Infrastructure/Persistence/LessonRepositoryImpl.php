<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Lesson;
use App\Domain\Repositories\LessonRepositoryInterface;
use App\Models\Lesson as LessonModel;
use App\Enums\ContentType;
use App\Exceptions\ApiException;

class LessonRepositoryImpl implements LessonRepositoryInterface
{
    public function create(Lesson $lesson): Lesson
    {
        $model = LessonModel::create([
            'module_id'    => $lesson->moduleId,
            'title'        => $lesson->title,
            'content_type' => $lesson->contentType->value,
            'content_url'  => $lesson->contentUrl,
            'duration'     => $lesson->duration,
            'order'        => $lesson->order,
        ]);

        return $this->toEntity($model);
    }

    public function update(Lesson $lesson): Lesson
    {
        $model = LessonModel::find($lesson->id);
        if (!$model) {
            throw new ApiException('Lesson not found');
        }

        $model->update([
            'title'        => $lesson->title,
            'content_type' => $lesson->contentType->value,
            'content_url'  => $lesson->contentUrl,
            'duration'     => $lesson->duration,
            'order'        => $lesson->order,
        ]);

        return $this->toEntity($model);
    }

    public function delete(int $id): void
    {
        $model = LessonModel::find($id);
        if (!$model) {
            throw new ApiException('Lesson not found');
        }
        $model->delete();
    }

    public function findById(int $id): ?Lesson
    {
        $model = LessonModel::find($id);
        return $model ? $this->toEntity($model) : null;
    }

    public function findByModule(int $moduleId): array
    {
        return LessonModel::where('module_id', $moduleId)
            ->orderBy('order', 'asc')
            ->get()
            ->map(fn($model) => $this->toEntity($model))
            ->toArray();
    }

    /**
     * Convert Eloquent model to Entity
     */
    private function toEntity(LessonModel $model): Lesson
    {
        return new Lesson(
            id: $model->id,
            moduleId: $model->module_id,
            title: $model->title,
            contentType: $model->content_type instanceof ContentType
                ? $model->content_type
                : ContentType::from($model->content_type),
            contentUrl: $model->content_url,
            duration: $model->duration,
            order: $model->order,
        );
    }
}
