<?php

namespace App\Application\UseCases\Quiz;

use App\Domain\Entities\QuizEntity;
use App\Domain\Repositories\QuizRepository;

class CreateQuiz
{
    public function __construct(private QuizRepository $repo) {}

    public function execute(array $data): QuizEntity
    {
        return $this->repo->create(
            new QuizEntity(
                id: null,
                courseId: $data['course_id'],
                title: $data['title'],
                totalScore: $data['total_score'],
                passingScore: $data['passing_score']
            )
        );
    }
}
