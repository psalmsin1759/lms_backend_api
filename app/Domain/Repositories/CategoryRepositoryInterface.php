<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Category;

interface CategoryRepositoryInterface
{
    public function create(Category $category): Category;
    public function update(Category $category): Category;
    public function findById(int $id): ?Category;
    public function findBySlug(string $slug): ?Category;
    public function all(): array;
    public function delete(int $id): void;
}