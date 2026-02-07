<?php

namespace App\Http\Requests\Enrollment;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\CompletionStatus;
use Illuminate\Validation\Rules\Enum;

class UpdateEnrollmentStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'completion_status' => ['required', new Enum(CompletionStatus::class)],
        ];
    }
}
