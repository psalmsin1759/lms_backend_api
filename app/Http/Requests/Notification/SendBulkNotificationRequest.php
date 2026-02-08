<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendBulkNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_ids'   => ['required', 'array', 'min:1'],
            'user_ids.*' => ['integer', 'exists:users,id'],
            'title'      => ['nullable', 'string', 'max:255'],
            'message'    => ['required', 'string'],
            'type'       => ['nullable', Rule::in(['info', 'success', 'warning', 'error'])],
        ];
    }
}
