<?php

namespace App\Application\UseCases\Quiz;

use App\Domain\Entities\QuizAttemptEntity;
use App\Domain\Repositories\QuestionRepository;
use App\Domain\Repositories\QuizRepository;
use App\Domain\Repositories\QuizAttemptRepository;


class SubmitQuizAnswers
{
    public function __construct(
        private QuestionRepository $questions,
        private QuizRepository $quizzes,
        private QuizAttemptRepository $attempts
    ) {}

    /**
     * answers = [
     *   question_id => user_answer
     * ]
     */
    public function execute(int $quizId, int $userId, array $answers)
    {
        $quiz = $this->quizzes->findById($quizId);
        $questions = $this->questions->getByQuiz($quizId);

        $score = 0;

        foreach ($questions as $question) {
            if (!isset($answers[$question->id])) {
                continue;
            }

            if (
                strtolower(trim($answers[$question->id])) ===
                strtolower(trim($question->correctAnswer))
            ) {
                $score += $question->score;
            }
        }

        $passed = $score >= $quiz->passingScore;

        return $this->attempts->create(
            new QuizAttemptEntity(
                id: null,
                quizId: $quizId,
                userId: $userId,
                score: $score,
                passed: $passed,
                attemptedAt: now()
            )
        );
    }
}
