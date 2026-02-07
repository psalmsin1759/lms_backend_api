<?php

namespace App\Application\UseCases\Course\Lesson;

use App\Domain\Entities\Lesson;
use App\Domain\Repositories\LessonRepositoryInterface;
use App\Enums\ContentType;

class CreateLesson
{
    public function __construct(private LessonRepositoryInterface $repo) {}

    public function execute(array $data): Lesson
    {
        $lesson = new Lesson(
            id: null,
            moduleId: $data['module_id'],
            title: $data['title'],
            contentType   : isset($data['content_type'])
                ? ContentType::from($data['content_type'])
                : ContentType::VIDEO,
            contentUrl: $data['content_url'] ?? null,
            duration: $data['duration'] ?? 0,
            order: $data['order'] ?? 1
        );

        return $this->repo->create($lesson);
    }
}