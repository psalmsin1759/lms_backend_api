<?php

namespace App\Application\UseCases\Category;

use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Domain\Entities\Category;
use RuntimeException;

class GetCategoryBySlug
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepo
    ) {}

    public function execute(string $slug): Category
    {
        $category = $this->categoryRepo->findBySlug($slug);

        if (!$category) {
            throw new RuntimeException('Category not found');
        }

        return $category;
    }
}
