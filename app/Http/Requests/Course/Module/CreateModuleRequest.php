<?php

namespace App\Http\Requests\Course\Module;

use Illuminate\Foundation\Http\FormRequest;

class CreateModuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_id' => ['required', 'integer', 'exists:courses,id'],
            'title'     => ['required', 'string', 'max:255'],
            'order'     => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'Course is required',
            'course_id.exists'   => 'Course not found',
            'title.required'     => 'Module title is required',
            'order.required'     => 'Module order is required',
        ];
    }
}
