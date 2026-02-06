<?php


namespace App\Application\UseCases\Auth;

use App\Application\Services\PermissionService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginUser
{

    public function __construct(
        protected PermissionService $permissionService
    ) {}
    
    public function execute(string $email, string $password): array
    {
        $user = User::whereEmail($email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials'],
            ]);
        }

        if ($user->two_factor_enabled) {
            return [
                'requires_2fa' => true,
                'user_id' => $user->id,
            ];
        }

        $permissions = $this->permissionService->forRole($user->role);

        return [
            'token' => $user->createToken('auth')->plainTextToken,
            'user'  => $user,
            'permissions' => $permissions,
        ];
    }
}
