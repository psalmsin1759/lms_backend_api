<?php

namespace App\Domain\Entities;

use App\Enums\CourseLevel;
use App\Enums\CourseStatus;

class Course
{
    public function __construct(
        public ?int $id,
        public int $instructorId,
        public string $title,
        public ?string $description,
        public string $slug,
        public CourseLevel $level,
        public int $duration, // in minutes
        public float $price,
        public CourseStatus $status
    ) {}
}
