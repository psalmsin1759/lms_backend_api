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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
