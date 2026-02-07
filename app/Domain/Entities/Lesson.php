<?php

namespace App\Domain\Entities;

use App\Enums\ContentType;

class Lesson
{
    public function __construct(
        public ?int $id,
        public int $moduleId,
        public string $title,
        public ContentType $contentType,
        public ?string $contentUrl,
        public int $duration, // in minutes
        public int $order
    ) {}
}
