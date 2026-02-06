<?php

namespace App\Domain\Entities;

class Category
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public ?string $description,
        public ?int $parentId,
        public bool $isActive = true
    ) {}
}
