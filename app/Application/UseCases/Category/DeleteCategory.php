<?php

namespace App\Application\UseCases\Category;

use App\Domain\Repositories\CategoryRepositoryInterface;
use RuntimeException;

class DeleteCategory
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepo
    ) {}

    public function execute(int $id): void
    {
        $category = $this->categoryRepo->findById($id);

        if (!$category) {
            throw new RuntimeException('Category not found');
        }

        $this->categoryRepo->delete($id);
    }
}
