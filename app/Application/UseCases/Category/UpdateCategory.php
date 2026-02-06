<?php

namespace App\Application\UseCases\Category;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Str;
use RuntimeException;

class UpdateCategory
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepo
    ) {}

    public function execute(int $id, array $data): Category
    {
        $existing = $this->categoryRepo->findById($id);

        if (!$existing) {
            throw new RuntimeException('Category not found');
        }

        $category = new Category(
            id: $id,
            name: $data['name'] ?? $existing->name,
            slug: isset($data['name'])
                ? Str::slug($data['name'])
                : $existing->slug,
            description: $data['description'] ?? $existing->description,
            parentId: $data['parent_id'] ?? $existing->parentId,
            isActive: $data['is_active'] ?? $existing->isActive
        );

        return $this->categoryRepo->update($category);
    }
}
