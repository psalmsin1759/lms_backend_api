<?php


namespace App\Application\UseCases\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePassword
{
    public function execute(User $user, string $current, string $new): void
    {
        if (!Hash::check($current, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Incorrect password'],
            ]);
        }

        $user->update([
            'password' => Hash::make($new),
        ]);
    }
}
