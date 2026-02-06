<?php

namespace App\Application\UseCases\Category;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepositoryInterface;
use RuntimeException;

class ToggleCategoryStatus
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepo
    ) {}

    public function execute(int $id): Category
    {
        $existing = $this->categoryRepo->findById($id);

        if (!$existing) {
            throw new RuntimeException('Category not found');
        }

        $category = new Category(
            id: $existing->id,
            name: $existing->name,
            slug: $existing->slug,
            description: $existing->description,
            parentId: $existing->parentId,
            isActive: !$existing->isActive
        );

        return $this->categoryRepo->update($category);
    }
}
