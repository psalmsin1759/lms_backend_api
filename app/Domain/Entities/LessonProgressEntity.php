<?php

namespace App\Domain\Entities;

use Carbon\Carbon;

class LessonProgressEntity
{
    public function __construct(
        public ?int $id,
        public int $enrollmentId,
        public int $lessonId,
        public ?Carbon $completedAt,
    ) {}

    public function markCompleted(): void
    {
        $this->completedAt = now();
    }

    public function isCompleted(): bool
    {
        return $this->completedAt !== null;
    }
}
