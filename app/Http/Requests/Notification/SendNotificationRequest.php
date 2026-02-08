<?php

namespace App\Http\Requests\Notification;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'title'   => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'type'    => ['nullable', Rule::in(['info', 'success', 'warning', 'error'])],
        ];
    }
}
