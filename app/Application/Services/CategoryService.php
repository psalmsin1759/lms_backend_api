<?php

namespace App\Application\Services;

use App\Application\UseCases\Category\CreateCategory;
use App\Application\UseCases\Category\GetCategoryById;
use App\Application\UseCases\Category\GetCategoryBySlug;
use App\Application\UseCases\Category\ListCategories;
use App\Application\UseCases\Category\UpdateCategory;
use App\Application\UseCases\Category\DeleteCategory;
use App\Application\UseCases\Category\ToggleCategoryStatus;
use App\Application\UseCases\Category\GetCategoryTree;
use App\Domain\Entities\Category;

class CategoryService
{
    public function __construct(
        private CreateCategory $createCategory,
        private ListCategories $listCategories,
        private GetCategoryById $getCategoryById,
        private GetCategoryBySlug $getCategoryBySlug,
        private UpdateCategory $updateCategory,
        private DeleteCategory $deleteCategory,
        private ToggleCategoryStatus $toggleCategoryStatus,
        private GetCategoryTree $getCategoryTree,
    ) {}

    /**
     * Create a new category
     */
    public function create(array $data): Category
    {
        return $this->createCategory->execute($data);
    }

    /**
     * List all categories (flat)
     */
    public function all(): array
    {
        return $this->listCategories->execute();
    }

    /**
     * Get category by ID
     */
    public function findById(int $id): Category
    {
        return $this->getCategoryById->execute($id);
    }

    /**
     * Get category by slug
     */
    public function findBySlug(string $slug): Category
    {
        return $this->getCategoryBySlug->execute($slug);
    }

    /**
     * Update category
     */
    public function update(int $id, array $data): Category
    {
        return $this->updateCategory->execute($id, $data);
    }

    /**
     * Delete category
     */
    public function delete(int $id): void
    {
        $this->deleteCategory->execute($id);
    }

    /**
     * Enable / Disable category
     */
    public function toggleStatus(int $id): Category
    {
        return $this->toggleCategoryStatus->execute($id);
    }

    /**
     * Get nested category tree
     */
    public function tree(): array
    {
        return $this->getCategoryTree->execute();
    }
}
