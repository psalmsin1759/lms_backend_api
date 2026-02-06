<?php

namespace App\Application\UseCases\Category;

use App\Models\Category;

class GetCategoryTree
{
    public function execute(): array
    {
        return Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->get()
            ->toArray();
    }
}
