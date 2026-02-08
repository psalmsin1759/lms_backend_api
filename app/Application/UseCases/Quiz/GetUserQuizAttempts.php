<?php

namespace App\Application\UseCases\Quiz;

use App\Domain\Repositories\QuizAttemptRepository;

class GetUserQuizAttempts
{
    public function __construct(private QuizAttemptRepository $repo) {}

    public function execute(int $quizId, int $userId): array
    {
        return $this->repo->getUserAttempts($quizId, $userId);
    }
}
