<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Repositories\QuizRepository;
use App\Domain\Entities\QuizEntity;
use App\Models\Quiz;

class QuizRepositoryImpl implements QuizRepository
{
    public function create(QuizEntity $quiz): QuizEntity
    {
        $model = Quiz::create([
            'course_id' => $quiz->courseId,
            'title' => $quiz->title,
            'total_score' => $quiz->totalScore,
            'passing_score' => $quiz->passingScore
        ]);

        return new QuizEntity(
            $model->id,
            $model->course_id,
            $model->title,
            $model->total_score,
            $model->passing_score
        );
    }

    public function findById(int $id): QuizEntity
    {
        $quiz = Quiz::findOrFail($id);

        return new QuizEntity(
            $quiz->id,
            $quiz->course_id,
            $quiz->title,
            $quiz->total_score,
            $quiz->passing_score
        );
    }

    public function getByCourse(int $courseId): array
    {
        return Quiz::where('course_id', $courseId)
            ->get()
            ->map(fn ($quiz) => new QuizEntity(
                $quiz->id,
                $quiz->course_id,
                $quiz->title,
                $quiz->total_score,
                $quiz->passing_score
            ))
            ->toArray();
    }
}
