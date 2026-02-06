<?php

namespace App\Application\UseCases\Category;

use App\Domain\Repositories\CategoryRepositoryInterface;

class ListCategories
{
    public function __construct(
        private CategoryRepositoryInterface $repository
    ) {}

    public function execute(): array
    {
        return $this->repository->all();
    }
}
