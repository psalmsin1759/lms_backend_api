<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\QuizEntity;

interface QuizRepository
{
    public function create(QuizEntity $quiz): QuizEntity;

    public function findById(int $id): QuizEntity;

    public function getByCourse(int $courseId): array;
}
