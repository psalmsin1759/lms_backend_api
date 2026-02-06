<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token'    => 'required|string',
            'email'    => 'required|email|exists:users,email',
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'The password reset token is required.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email address.',
            'email.exists' => 'The selected email address does not exist in our records.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
