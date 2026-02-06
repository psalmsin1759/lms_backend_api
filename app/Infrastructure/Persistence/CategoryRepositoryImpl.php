<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Models\Category as CategoryModel;

class CategoryRepositoryImpl implements CategoryRepositoryInterface
{
    public function create(Category $category): Category
    {
        $model = CategoryModel::create([
            'name'        => $category->name,
            'slug'        => $category->slug,
            'description' => $category->description,
            'parent_id'   => $category->parentId,
            'is_active'   => $category->isActive,
        ]);

        return $this->toEntity($model);
    }

    public function update(Category $category): Category
    {
        $model = CategoryModel::findOrFail($category->id);

        $model->update([
            'name'        => $category->name,
            'slug'        => $category->slug,
            'description' => $category->description,
            'parent_id'   => $category->parentId,
            'is_active'   => $category->isActive,
        ]);

        return $this->toEntity($model);
    }

    public function findById(int $id): ?Category
    {
        $model = CategoryModel::find($id);

        return $model ? $this->toEntity($model) : null;
    }

    public function findBySlug(string $slug): ?Category
    {
        $model = CategoryModel::where('slug', $slug)->first();

        return $model ? $this->toEntity($model) : null;
    }

    public function all(): array
    {
        return CategoryModel::orderBy('name')
            ->get()
            ->map(fn ($model) => $this->toEntity($model))
            ->toArray();
    }

    public function delete(int $id): void
    {
        CategoryModel::where('id', $id)->delete();
    }

    public function tree(): array
    {
        return CategoryModel::whereNull('parent_id')
            ->with('childrenRecursive')
            ->get()
            ->toArray();
    }


    private function toEntity(CategoryModel $model): Category
    {
        return new Category(
            id: $model->id,
            name: $model->name,
            slug: $model->slug,
            description: $model->description,
            parentId: $model->parent_id,
            isActive: (bool) $model->is_active
        );
    }
}
