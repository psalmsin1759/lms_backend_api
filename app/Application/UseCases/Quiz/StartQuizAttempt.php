<?php

namespace App\Application\UseCases\Quiz;

use App\Domain\Entities\QuizAttemptEntity;
use App\Domain\Repositories\QuizAttemptRepository;
use Carbon\Carbon;

class StartQuizAttempt
{
    public function __construct(private QuizAttemptRepository $repo) {}

    public function execute(int $quizId, int $userId): QuizAttemptEntity
    {
        return $this->repo->create(
            new QuizAttemptEntity(
                id: null,
                quizId: $quizId,
                userId: $userId,
                score: 0,
                passed: false,
                attemptedAt: Carbon::now()
            )
        );
    }
}
