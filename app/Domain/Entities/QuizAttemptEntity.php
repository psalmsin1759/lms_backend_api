<?php

namespace App\Domain\Entities;

use DateTimeInterface;

class QuizAttemptEntity
{
    public function __construct(
        public ?int $id,
        public int $quizId,
        public int $userId,
        public int $score,
        public bool $passed,
        public DateTimeInterface $attemptedAt
    ) {}
}
