<?php

namespace App\Domain\Entities;

class Module
{
    public function __construct(
        public ?int $id,
        public int $courseId,
        public string $title,
        public int $order
    ) {}
}
