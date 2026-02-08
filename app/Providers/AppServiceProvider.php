<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\Repositories\CategoryRepositoryInterface::class,
            \App\Infrastructure\Persistence\CategoryRepositoryImpl::class
        );
        $this->app->bind(
            \App\Domain\Repositories\CourseRepositoryInterface::class,
            \App\Infrastructure\Persistence\CourseRepositoryImpl::class
        );
        $this->app->bind(
            \App\Domain\Repositories\ModuleRepositoryInterface::class,
            \App\Infrastructure\Persistence\ModuleRepositoryImpl::class
        );
        $this->app->bind(
            \App\Domain\Repositories\LessonRepositoryInterface::class,
            \App\Infrastructure\Persistence\LessonRepositoryImpl::class
        );
        $this->app->bind(
            \App\Domain\Repositories\EnrollmentRepositoryInterface::class,
            \App\Infrastructure\Persistence\EnrollmentRepositoryImpl::class
        );
        $this->app->bind(
            \App\Domain\Repositories\LessonProgressRepository::class,
            \App\Infrastructure\Persistence\LessonProgressRepositoryImpl::class
        );
        $this->app->bind(
            \App\Domain\Repositories\QuestionRepository::class,
            \App\Infrastructure\Persistence\QuestionRepositoryImpl::class
        );
        $this->app->bind(
            \App\Domain\Repositories\QuizRepository::class,
            \App\Infrastructure\Persistence\QuizRepositoryImpl::class
        );
        $this->app->bind(
            \App\Domain\Repositories\QuizAttemptRepository::class,
            \App\Infrastructure\Persistence\QuizAttemptRepositoryImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
