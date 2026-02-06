<?php

namespace App\Application\Services;

use App\Application\UseCases\Auth\RegisterUser;
use App\Application\UseCases\Auth\LoginUser;
use App\Application\UseCases\Auth\ChangePassword;
use App\Application\UseCases\Auth\ResetPassword;
use App\Application\UseCases\Auth\SendPasswordReset;
use App\Models\User;

class AuthService
{
    public function __construct(
        protected RegisterUser $registerUser,
        protected LoginUser $loginUser,
        protected ChangePassword $changePassword,
        protected SendPasswordReset $sendPasswordReset,
        protected ResetPassword $resetPassword,
    ) {}

    
    public function register(array $data): array
    {
        return $this->registerUser->execute($data);
    }

   
    public function login(string $email, string $password): array
    {
        return $this->loginUser->execute($email, $password);
    }

   
    public function changePassword(
        User $user,
        string $currentPassword,
        string $newPassword
    ): void {
        $this->changePassword->execute(
            $user,
            $currentPassword,
            $newPassword
        );
    }

    
    public function forgotPassword(string $email): void
    {
        $this->sendPasswordReset->execute($email);
    }

    public function resetPassword(
        string $email,
        string $token,
        string $newPassword
    ): void {
        $this->resetPassword->execute($email, $token, $newPassword);
    }   

    
   /*  public function logout(User $user): void
    {
        $user->currentAccessToken()?->delete();
    } */
}
