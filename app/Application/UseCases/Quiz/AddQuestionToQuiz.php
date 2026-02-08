<?php

namespace App\Application\UseCases\Quiz;

use App\Domain\Entities\QuestionEntity;
use App\Domain\Repositories\QuestionRepository;

class AddQuestionToQuiz
{
    public function __construct(private QuestionRepository $repo) {}

    public function execute(array $data): QuestionEntity
    {
        return $this->repo->create(
            new QuestionEntity(
                id: null,
                quizId: $data['quiz_id'],
                questionText: $data['question_text'],
                questionType: $data['question_type'],
                options: $data['options'] ?? null,
                correctAnswer: $data['correct_answer'],
                score: $data['score']
            )
        );
    }
}
