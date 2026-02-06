<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * Register exception handling callbacks.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {

            if (!$request->expectsJson()) {
                return null;
            }

            return response()->json(
                $this->formatException($e),
                $this->getStatusCode($e)
            );
        });
    }

    protected function formatException(Throwable $e): array
    {
        if ($e instanceof ValidationException) {
            return [
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ];
        }

        if ($e instanceof AuthenticationException) {
            return [
                'message' => 'Unauthenticated',
            ];
        }

        if ($e instanceof AuthorizationException) {
            return [
                'message' => 'Forbidden',
            ];
        }

        if ($e instanceof ModelNotFoundException) {
            return [
                'message' => 'Resource not found',
            ];
        }

        if ($e instanceof NotFoundHttpException) {
            return [
                'message' => 'Endpoint not found',
            ];
        }

        if ($e instanceof HttpExceptionInterface) {
            return [
                'message' => $e->getMessage() ?: 'HTTP error',
            ];
        }

        // Fallback (500)
        return [
            'message' => config('app.debug')
                ? $e->getMessage()
                : 'Something went wrong',
        ];
    }

    protected function getStatusCode(Throwable $e): int
    {
        return match (true) {
            $e instanceof ValidationException        => 422,
            $e instanceof AuthenticationException   => 401,
            $e instanceof AuthorizationException    => 403,
            $e instanceof ModelNotFoundException,
            $e instanceof NotFoundHttpException     => 404,
            $e instanceof HttpExceptionInterface    => $e->getStatusCode(),
            default                                 => 500,
        };
    }
}
