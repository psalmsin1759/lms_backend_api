<?php

namespace App\Domain\Entities;

class QuestionEntity
{
    public function __construct(
        public ?int $id,
        public int $quizId,
        public string $questionText,
        public string $questionType,
        public ?array $options,
        public string $correctAnswer,
        public int $score
    ) {}
}
