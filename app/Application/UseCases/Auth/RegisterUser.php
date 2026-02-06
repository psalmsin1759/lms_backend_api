<?php

namespace App\Application\UseCases\Auth;

use App\Application\Services\PermissionService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUser
{

    public function __construct(
        protected PermissionService $permissionService
    ) {}
    
     public function execute(array $data): array
    {
        $user = User::create([
            'first_name'     => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'phone'    => $data['phone'],
            'role' => $data["role"]
        ]);

        $permissions = $this->permissionService->forRole($user->role);

        return [
            'token' => $user->createToken('auth')->plainTextToken,
            'user'  => $user,
            'permissions' => $permissions,
        ];
    }
}
