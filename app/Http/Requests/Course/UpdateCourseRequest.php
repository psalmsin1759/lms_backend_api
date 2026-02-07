<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\CourseLevel;
use App\Enums\CourseStatus;
use Illuminate\Validation\Rules\Enum;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'            => 'required|integer|exists:courses,id',
            'title'         => 'sometimes|string|max:255',
            'description'   => 'sometimes|nullable|string',
            'level'         => ['sometimes', new Enum(CourseLevel::class)],
            'language'      => 'sometimes|string|max:50',
            'duration'      => 'sometimes|integer|min:1',
            'price'         => 'sometimes|numeric|min:0',
            'status'        => ['sometimes', new Enum(CourseStatus::class)],
        ];
    }
}
