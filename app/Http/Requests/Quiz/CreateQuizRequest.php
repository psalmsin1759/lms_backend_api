<?php

namespace App\Http\Requests\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuizRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id'     => ['required', 'integer', 'exists:courses,id'],
            'title'         => ['required', 'string', 'max:255'],
            'total_score'   => ['required', 'integer', 'min:1'],
            'passing_score' => ['required', 'integer', 'lt:total_score'],
        ];
    }
}
