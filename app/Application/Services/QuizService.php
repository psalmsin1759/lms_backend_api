<?php

namespace App\Application\Services;

use App\Application\UseCases\Quiz\{
    CreateQuiz,
    AddQuestionToQuiz,
    StartQuizAttempt,
    SubmitQuizAnswers,
    GetUserQuizAttempts
};
use App\Domain\Entities\QuizEntity;
use App\Domain\Entities\QuestionEntity;
use App\Domain\Entities\QuizAttemptEntity;

class QuizService
{
    public function __construct(
        private CreateQuiz $createQuiz,
        private AddQuestionToQuiz $addQuestion,
        private StartQuizAttempt $startAttempt,
        private SubmitQuizAnswers $submitAnswers,
        private GetUserQuizAttempts $userAttempts
    ) {}

   

    public function createQuiz(array $data): QuizEntity
    {
        return $this->createQuiz->execute($data);
    }

   

    public function addQuestion(array $data): QuestionEntity
    {
        return $this->addQuestion->execute($data);
    }

  

    public function startAttempt(int $quizId, int $userId): QuizAttemptEntity
    {
        return $this->startAttempt->execute($quizId, $userId);
    }

    public function submitAnswers(
        int $quizId,
        int $userId,
        array $answers
    ): QuizAttemptEntity {
        return $this->submitAnswers->execute($quizId, $userId, $answers);
    }

    public function getAttempts(int $quizId, int $userId): array
    {
        return $this->userAttempts->execute($quizId, $userId);
    }
}
