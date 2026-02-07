<?php

namespace App\Domain\Entities;

use App\Enums\CompletionStatus;

class Enrollment
{
    public function __construct(
        public ?int $id,
        public int $userId,
        public int $courseId,
        public \DateTime $enrolledAt,
        public CompletionStatus $completionStatus,
        public ?\DateTime $completionDate = null,
    ) {}
}
