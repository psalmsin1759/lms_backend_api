<?php

namespace App\Http\Controllers;

use App\Application\Services\AuthService;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    protected AuthService $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterFormRequest $request)
    {
        $data = $request->validated();

        $result = $this->authService->register($data);

        return ApiResponse::success(
            [
                'user'  => new UserResource($result['user']),
                'token' => $result['token'],
                'permissions' => $result['permissions'],
            ],
            'User created successfully',
            201
        );
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $result = $this->authService->login($credentials['email'], $credentials['password']);

        return ApiResponse::success(
            [
                'user'  => new UserResource($result['user']),
                'token' => $result['token'],
                'permissions' => $result['permissions'],
            ],
            'User logged in successfully',
            201
        );

    }


    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $data = $request->validated();

        $this->authService->forgotPassword($data['email']);

        return ApiResponse::success(
            "",
            'Password reset email sent successfully',
            200
        );

    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $data = $request->validated();

        $this->authService->resetPassword(
            $data['email'],
            $data['token'],
            $data['new_password']
        );
        return ApiResponse::success(
            "",
            'Password reset successfully',
            200
        );

    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $data = $request->validated();

        $this->authService->changePassword(
            $request->user(),
            $data['current_password'],
            $data['password']
        );

         return ApiResponse::success(
            "",
            'Password changed successfully',
            200
        );

    }
}
