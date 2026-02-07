<?php

namespace App\Application\Services;

use App\Application\UseCases\Course\Lesson\CreateLesson;
use App\Application\UseCases\Course\Lesson\DeleteLesson;
use App\Application\UseCases\Course\Lesson\GetLessonById;
use App\Application\UseCases\Course\Lesson\GetLessonsByModule;
use App\Application\UseCases\Course\Lesson\UpdateLesson;
use App\Domain\Entities\Lesson;
use App\Domain\Repositories\LessonRepositoryInterface;
use App\Infrastructure\Files\UploadFileProcessor;
use App\Exceptions\ApiException;

class LessonService
{
    public function __construct(
        private CreateLesson $create,
        private UpdateLesson $update,
        private DeleteLesson $delete,
        private GetLessonById $getById,
        private GetLessonsByModule $getByModule,
        private LessonRepositoryInterface $lessonRepo,
        private UploadFileProcessor $uploader,
    ) {}

    public function create(array $data): Lesson
    {
        return $this->create->execute($data);
    }

    public function update(array $data): Lesson
    {
        $lesson = $this->lessonRepo->findById($data['id']);

        if (!$lesson) {
            throw new ApiException('Lesson not found');
        }

       
        if (
            !empty($data['content_url']) &&
            $lesson->contentUrl &&
            $lesson->contentUrl !== $data['content_url']
        ) {
            $oldPath = $this->uploader->pathFromUrl($lesson->contentUrl);
            $this->uploader->delete($oldPath);
        }

        return $this->update->execute($data);
    }

    public function delete(int $id): void
    {
        $lesson = $this->lessonRepo->findById($id);

        if (!$lesson) {
            throw new ApiException('Lesson not found');
        }

      
        if ($lesson->contentUrl) {
            $path = $this->uploader->pathFromUrl($lesson->contentUrl);
            $this->uploader->delete($path);
        }

        $this->delete->execute($id);
    }

    public function findById(int $id): Lesson
    {
        return $this->getById->execute($id);
    }

    public function getByModule(int $moduleId): array
    {
        return $this->getByModule->execute($moduleId);
    }
}
