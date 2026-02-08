<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Repositories\QuestionRepository;
use App\Domain\Entities\QuestionEntity;
use App\Models\Question;

class QuestionRepositoryImpl implements QuestionRepository
{
    public function create(QuestionEntity $question): QuestionEntity
    {
        $model = Question::create([
            'quiz_id' => $question->quizId,
            'question_text' => $question->questionText,
            'question_type' => $question->questionType,
            'options'        => $question->options,
            'correct_answer' => $question->correctAnswer,
            'score' => $question->score
        ]);

        return new QuestionEntity(
            $model->id,
            $model->quiz_id,
            $model->question_text,
            $model->question_type,
            $model->options,
            $model->correct_answer,
            $model->score
        );
    }

    public function getByQuiz(int $quizId): array
    {
        return Question::where('quiz_id', $quizId)
            ->get()
            ->map(fn ($q) => new QuestionEntity(
                $q->id,
                $q->quiz_id,
                $q->question_text,
                $q->question_type,
                $q->options,
                $q->correct_answer,
                $q->score
            ))
            ->toArray();
    }
}
