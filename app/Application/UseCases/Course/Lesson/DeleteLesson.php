<?php

namespace App\Application\UseCases\Course\Lesson;


use App\Domain\Repositories\LessonRepositoryInterface;

class DeleteLesson
{
    public function __construct(private LessonRepositoryInterface $repo) {}

    public function execute(int $id): void
    {
        $this->repo->delete($id);
    }
}