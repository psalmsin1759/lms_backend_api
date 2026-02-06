<?php

namespace App\Application\UseCases\Category;

use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Domain\Entities\Category;
use App\Exceptions\ApiException;
use RuntimeException;

class GetCategoryById
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepo
    ) {}

    public function execute(int $id): Category
    {
        $category = $this->categoryRepo->findById($id);

        if (!$category) {
            throw new ApiException('Category not found', 404);
        }

        return $category;
    }
}
