<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\CourseStatus;
use App\Enums\CourseLevel;
use Illuminate\Validation\Rules\Enum;

class CourseListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'        => 'nullable|string|max:255',
            'status'        => ['nullable', new Enum(CourseStatus::class)],
            'level'         => ['nullable', new Enum(CourseLevel::class)],
            'instructor_id' => 'nullable|integer|exists:users,id',
            'page'          => 'nullable|integer|min:1',
            'per_page'      => 'nullable|integer|min:1|max:100',
            'order_by'      => 'nullable|in:title,created_at',
            'order_dir'     => 'nullable|in:asc,desc',
        ];
    }
}
