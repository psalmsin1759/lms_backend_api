<?php


namespace App\Application\UseCases\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class SendPasswordReset
{
    public function execute(string $email): void
    {
        $user = User::whereEmail($email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['User not found.']
            ]);
        }

        $status = Password::sendResetLink(['email' => $email]);

        if ($status !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages([
                'email' => ['Unable to send password reset email.']
            ]);
        }
    }
}
