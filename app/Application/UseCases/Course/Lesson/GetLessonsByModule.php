<?php

namespace App\Application\UseCases\Course\Lesson;

use App\Domain\Repositories\LessonRepositoryInterface;

class GetLessonsByModule
{
    public function __construct(private LessonRepositoryInterface $repo) {}

    public function execute(int $moduleId): array
    {
        return $this->repo->findByModule($moduleId);
    }
}