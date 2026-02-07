<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\CourseLevel;
use Illuminate\Validation\Rules\Enum;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'level'         => ['required', new Enum(CourseLevel::class)],
            'duration'      => 'required|integer|min:1',
            'price'         => 'required|numeric|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Course title is required',
            'duration.min'   => 'Duration must be at least 1 minute',
        ];
    }
}
