<?php

namespace App\Http\Controllers;

use App\Application\Services\ModuleService;
use App\Http\Requests\Course\Module\CreateModuleRequest;
use App\Http\Requests\Course\Module\UpdateModuleRequest;
use App\Models\Module;
use App\Utils\ApiResponse;
use Illuminate\Http\JsonResponse;

class ModuleController extends Controller
{
    public function __construct(private ModuleService $moduleService) {}

   

    public function show(int $id): JsonResponse
    {
        $module = $this->moduleService->findById($id);
        return ApiResponse::success(
            $module,
            'Module retrieved successfully'
        );
    }

    public function store(CreateModuleRequest $request): JsonResponse
    {
        $module = $this->moduleService->create($request->validated());
        return ApiResponse::success(
            $module,
            'Module created successfully'
        );
    }

    public function update(UpdateModuleRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $data['id'] = $id;
        $module = $this->moduleService->update($data);
        return ApiResponse::success(
            $module,
            'Module updated successfully'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $this->moduleService->delete($id);
        return ApiResponse::success(
            null,
            'Module deleted successfully'
        );
    }

    public function getByCourse(int $courseId): JsonResponse
    {
        $modules = $this->moduleService->getByCourse($courseId);
        return ApiResponse::success($modules, 'Modules retrieved successfully');
    }
}
