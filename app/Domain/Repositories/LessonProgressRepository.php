<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\LessonProgressEntity;

interface LessonProgressRepository
{
    public function findByEnrollmentAndLesson(
        int $enrollmentId,
        int $lessonId
    ): ?LessonProgressEntity;

    public function create(LessonProgressEntity $progress): LessonProgressEntity;

    public function markLessonCompleted(
        int $enrollmentId,
        int $lessonId
    ): void;

    public function countCompletedLessons(int $enrollmentId): int;
}
