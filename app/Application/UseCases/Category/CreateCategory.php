<?php

namespace App\Application\UseCases\Category;


use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CreateCategory
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {}

    public function execute(array $data): Category
    {
        $category = new Category(
            id: null,
            parentId: $data["parent_id"] ?? null,
            name: $data["name"],
            slug: Str::slug($data["name"]),
            description: $data["description"] ?? null,
            isActive: true
        );

        return $this->repository->create($category);
    }
}
