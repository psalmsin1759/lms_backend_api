<?php

namespace App\Http\Controllers;


use App\Application\Services\LessonService;
use App\Http\Requests\Course\Lesson\CreateLessonRequest;
use App\Http\Requests\Course\Lesson\UpdateLessonRequest;
use App\Infrastructure\Files\UploadFileProcessor;
use App\Utils\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function __construct(private LessonService $service, private UploadFileProcessor $uploader) {}

    public function index(int $moduleId): JsonResponse
    {
        $lessons = $this->service->getByModule($moduleId);

        return ApiResponse::success(
            $lessons,
            'Lessons retrieved successfully'
        );
        
    }

    public function show(int $id): JsonResponse
    {
        $lesson = $this->service->findById($id);
        return ApiResponse::success($lesson, 'Lesson retrieved successfully');
    
    }

    public function store(CreateLessonRequest $request)
    {
        $data = $request->validated();

        $fileData = $this->uploader->handle(
            file: $request->file('content'),
            directory: 'lessons/content'
        );

        $lesson = $this->service->create(array_merge($data, ['content_url' => $fileData['url']]));
        return ApiResponse::success(
            $lesson,
            'Lesson created successfully',
            201
        );
       
    }

    public function update(UpdateLessonRequest $request, int $id)
    {
        $data = $request->validated();

        if ($request->hasFile('content')) {
            $fileData = $this->uploader->handle(
                file: $request->file('content'),
                directory: 'lessons/content'
            );

            $data['content_url'] = $fileData['url'];
        }

        $lesson = $this->service->update([
            ...$data,
            'id' => $id,
        ]);

        return ApiResponse::success(
            $lesson,
            'Lesson updated successfully'
        );
    }


    public function destroy(int $id)
    {
        $this->service->delete($id);
        return ApiResponse::success(
            null,
            'Lesson deleted successfully'
        );
    }

    public function markCompleted(Request $request)
    {
        $validated = $request->validate([
            'enrollment_id' => 'required|integer',
            'lesson_id' => 'required|integer',
        ]);

        $enrollmentId = $validated['enrollment_id'];
        $lessonId = $validated['lesson_id'];

        $progress = $this->service->markLessonCompleted($enrollmentId, $lessonId);
        return ApiResponse::success(
            $progress,
            'Lesson marked as completed'
        );
    }
}
