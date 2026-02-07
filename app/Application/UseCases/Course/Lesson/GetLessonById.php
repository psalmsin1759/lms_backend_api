<?php

namespace App\Application\UseCases\Course\Lesson;

use App\Domain\Entities\Lesson;
use App\Domain\Repositories\LessonRepositoryInterface;
use App\Exceptions\ApiException;

class GetLessonById
{
    public function __construct(private LessonRepositoryInterface $repo) {}

    public function execute(int $id): Lesson
    {
        $lesson = $this->repo->findById($id);
        if (!$lesson) {
            throw new ApiException("Lesson not found");
        }

        return $lesson;
    }
}