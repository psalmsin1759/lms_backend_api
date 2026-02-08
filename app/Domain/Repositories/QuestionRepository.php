<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\QuestionEntity;

interface QuestionRepository
{
    public function create(QuestionEntity $question): QuestionEntity;

    public function getByQuiz(int $quizId): array;
}
