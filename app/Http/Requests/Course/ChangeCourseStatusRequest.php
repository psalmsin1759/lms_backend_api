<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\CourseStatus;
use Illuminate\Validation\Rules\Enum;

class ChangeCourseStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', new Enum(CourseStatus::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'The course status is required.',
            'status.enum'     => 'The selected status is invalid. Allowed values: draft, published, archived.',
        ];
    }
}
