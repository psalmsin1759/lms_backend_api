<?php

namespace App\Http\Requests\Course\Lesson;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ContentType;
use Illuminate\Validation\Rules\Enum;

class CreateLessonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'module_id'    => ['required', 'integer', 'exists:modules,id'],
            'title'        => ['required', 'string', 'max:255'],
            'content_type' => ['required', new Enum(ContentType::class)],
            'content'      => ['required', 'file', 'mimes:mp4,webm,avi,mov,mp3,wav,aac,pdf'],
            'duration'     => ['nullable', 'integer', 'min:0'],
            'order'        => ['nullable', 'integer', 'min:1'],
        ];
    }
}
