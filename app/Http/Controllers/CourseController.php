<?php

namespace App\Http\Controllers;

use App\Application\Services\CourseService;
use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Http\Requests\Course\CourseListRequest;
use App\Http\Requests\Course\ChangeCourseStatusRequest;
use App\Enums\CourseStatus;
use App\Utils\ApiResponse;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function __construct(
        private CourseService $courseService
    ) {}

    /**
     * GET /courses
     */
    public function index(CourseListRequest $request)
    {
        $result = $this->courseService->list($request->validated());

        return ApiResponse::success(
            $result,
            'Courses retrieved successfully',
            200,
            $result['meta']
        );
    }

    /**
     * GET /courses/{id}
     */
    public function show(int $id)
    {
        $course = $this->courseService->findById($id);

        return ApiResponse::success(
            $course,
            'Course retrieved successfully'
        );
    }

    public function showBySlug(string $slug)
    {
        $course = $this->courseService->findBySlug($slug);

        return ApiResponse::success(
            $course,
            'Course retrieved successfully'
        );
    }

    public function byInstructor(int $instructorId)
    {
        $courses = $this->courseService->findByInstructor($instructorId);

        return ApiResponse::success(
            $courses,
            'Courses retrieved successfully'
        );
    }

    /**
     * POST /courses
     */
    public function store(StoreCourseRequest $request)
    {
        $course = $this->courseService->create(
            $request->validated()
        );

        return ApiResponse::success(
            $course,
            'Course created successfully',
            201
        );
    }

    /**
     * PUT /courses/{id}
     */
    public function update(UpdateCourseRequest $request, int $id)
    {
        $course = $this->courseService->update(
            array_merge(
                $request->validated(),
                ['id' => $id]
            )
        );

        return ApiResponse::success(
            $course,
            'Course updated successfully'
        );
    }

    /**
     * PATCH /courses/{id}/status
     */
    public function changeStatus(ChangeCourseStatusRequest $request, int $id)
    {
        $course = $this->courseService->changeStatus(
            $id,
            CourseStatus::from($request->validated()['status'])
        );

        return ApiResponse::success(
            $course,
            'Course status updated successfully'
        );
    }

    /**
     * DELETE /courses/{id}
     */
    public function destroy(int $id)
    {
        $this->courseService->delete($id);

        return ApiResponse::success(
            null,
            'Course deleted successfully'
        );
    }
}
