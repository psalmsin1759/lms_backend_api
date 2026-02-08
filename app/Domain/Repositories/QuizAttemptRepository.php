<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\QuizAttemptEntity;

interface QuizAttemptRepository
{
    public function create(QuizAttemptEntity $attempt): QuizAttemptEntity;

    public function getUserAttempts(int $quizId, int $userId): array;

    public function getLatestAttempt(int $quizId, int $userId): ?QuizAttemptEntity;
}
