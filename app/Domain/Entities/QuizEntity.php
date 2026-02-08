<?php

namespace App\Domain\Entities;

class QuizEntity
{
    public function __construct(
        public ?int $id,
        public int $courseId,
        public string $title,
        public int $totalScore,
        public int $passingScore
    ) {}
}
