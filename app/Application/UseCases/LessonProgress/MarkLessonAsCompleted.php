<?php

namespace App\Application\UseCases\LessonProgress;

use App\Domain\Entities\LessonProgressEntity;
use App\Domain\Repositories\LessonProgressRepository;
use App\Exceptions\ApiException;

class MarkLessonAsCompleted
{
    public function __construct(private LessonProgressRepository $repo) {}

    public function execute(int $enrollmentId, int $lessonId): LessonProgressEntity
    {
        $existing = $this->repo->findByEnrollmentAndLesson($enrollmentId, $lessonId);

        if ($existing && $existing->isCompleted()) {
            throw new ApiException('Lesson already completed');
        }

        if ($existing) {
            $this->repo->markLessonCompleted($enrollmentId, $lessonId);
            $updated = $this->repo->findByEnrollmentAndLesson($enrollmentId, $lessonId);
            if (!$updated) {
                throw new ApiException('Failed to mark lesson as completed');
            }
            return $updated;
        }

        $entity = new LessonProgressEntity(
            id: null,
            enrollmentId: $enrollmentId,
            lessonId: $lessonId,
            completedAt: now(),
        );

        return $this->repo->create($entity);
    }
}