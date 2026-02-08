<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Repositories\QuizAttemptRepository;
use App\Domain\Entities\QuizAttemptEntity;
use App\Models\QuizAttempt;

class QuizAttemptRepositoryImpl implements QuizAttemptRepository
{
    public function create(QuizAttemptEntity $attempt): QuizAttemptEntity
    {
        $model = QuizAttempt::create([
            'quiz_id' => $attempt->quizId,
            'user_id' => $attempt->userId,
            'score' => $attempt->score,
            'passed' => $attempt->passed,
            'attempted_at' => $attempt->attemptedAt
        ]);

        return new QuizAttemptEntity(
            $model->id,
            $model->quiz_id,
            $model->user_id,
            $model->score,
            $model->passed,
            $model->attempted_at
        );
    }

    public function getUserAttempts(int $quizId, int $userId): array
    {
        return QuizAttempt::where(compact('quizId', 'userId'))
            ->get()
            ->map(fn ($a) => new QuizAttemptEntity(
                $a->id,
                $a->quiz_id,
                $a->user_id,
                $a->score,
                $a->passed,
                $a->attempted_at
            ))
            ->toArray();
    }

    public function getLatestAttempt(int $quizId, int $userId): ?QuizAttemptEntity
    {
        $attempt = QuizAttempt::where('quiz_id', $quizId)
            ->where('user_id', $userId)
            ->latest('attempted_at')
            ->first();

        return $attempt
            ? new QuizAttemptEntity(
                $attempt->id,
                $attempt->quiz_id,
                $attempt->user_id,
                $attempt->score,
                $attempt->passed,
                $attempt->attempted_at
            )
            : null;
    }
}
