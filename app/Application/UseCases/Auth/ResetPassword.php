<?php

namespace App\Application\UseCases\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPassword
{
    
    public function execute(string $email, string $token, string $newPassword): void
    {
        $status = Password::reset(
            [
                'email' => $email,
                'password' => $newPassword,
                'password_confirmation' => $newPassword,
                'token' => $token,
            ],
            function (User $user) use ($newPassword) {
                
                $user->password = Hash::make($newPassword);

               
                $user->tokens()->delete();

                $user->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages([
                'token' => ['Invalid or expired password reset token.'],
            ]);
        }
    }
}
