<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quiz_id'        => ['required', 'integer', 'exists:quizzes,id'],
            'question_text' => ['required', 'string'],
            'question_type' => [
                'required',
                Rule::in(['mcq', 'true_false', 'short_answer']),
            ],
            'options'        => [
                'nullable',
                'array',
                'required_if:question_type,mcq',
                'min:2'
            ],

            'correct_answer'=> ['required', 'string'],
            'score'         => ['required', 'integer', 'min:1'],
        ];
    }
}
