<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\LessonProgressEntity;
use App\Models\LessonProgress;
use App\Domain\Repositories\LessonProgressRepository;

class LessonProgressRepositoryImpl implements LessonProgressRepository
{
    public function findByEnrollmentAndLesson(
        int $enrollmentId,
        int $lessonId
    ): ?LessonProgressEntity {
        $progress = LessonProgress::where('enrollment_id', $enrollmentId)
            ->where('lesson_id', $lessonId)
            ->first();

        return $progress ? $this->toEntity($progress) : null;
    }

    public function create(LessonProgressEntity $entity): LessonProgressEntity
    {
        $progress = LessonProgress::create([
            'enrollment_id' => $entity->enrollmentId,
            'lesson_id' => $entity->lessonId,
            'completed_at' => $entity->completedAt,
        ]);

        return $this->toEntity($progress);
    }

    public function markLessonCompleted(
        int $enrollmentId,
        int $lessonId
    ): void {
        LessonProgress::updateOrCreate(
            [
                'enrollment_id' => $enrollmentId,
                'lesson_id' => $lessonId,
            ],
            [
                'completed_at' => now(),
            ]
        );
    }

    public function countCompletedLessons(int $enrollmentId): int
    {
        return LessonProgress::where('enrollment_id', $enrollmentId)
            ->whereNotNull('completed_at')
            ->count();
    }

    private function toEntity(LessonProgress $model): LessonProgressEntity
    {
        return new LessonProgressEntity(
            $model->id,
            $model->enrollment_id,
            $model->lesson_id,
            $model->completed_at
        );
    }
}
