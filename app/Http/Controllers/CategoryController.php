<?php

namespace App\Http\Controllers;

use App\Application\Services\CategoryService;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest as CategoryUpdateCategoryRequest;
use App\Utils\ApiResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->categoryService->all();

        return ApiResponse::success(
            $categories,
            'Categories retrieved successfully'
        );
    }

    public function tree(): JsonResponse
    {
        $categories = $this->categoryService->tree();

        return ApiResponse::success(
            $categories,
            'Category tree retrieved successfully'
        );
    }

    public function show(int $id): JsonResponse
    {
        $category = $this->categoryService->findById($id);

        return ApiResponse::success(
            $category,
            'Category retrieved successfully'
        );
    }

    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $category = $this->categoryService->create(
            $request->validated()
        );

        return ApiResponse::success(
            $category,
            'Category created successfully',
            201
        );
    }

    public function update(
        CategoryUpdateCategoryRequest $request,
        int $id
    ): JsonResponse {
        $category = $this->categoryService->update(
            $id,
            $request->validated()
        );

        return ApiResponse::success(
            $category,
            'Category updated successfully'
        );
    }

    public function toggle(int $id): JsonResponse
    {
        $category = $this->categoryService->toggleStatus($id);

        return ApiResponse::success(
            $category,
            'Category status updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->categoryService->delete($id);

        return ApiResponse::success(
            null,
            'Category deleted successfully'
        );
    }
}