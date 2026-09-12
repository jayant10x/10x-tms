<?php

namespace App\Providers;

use App\Services\PermissionService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\EncryptionService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind your manual service class into Laravel's container system
        $this->app->singleton(EncryptionService::class, function ($app) {
            return new EncryptionService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        View::composer('*', function ($view) {
            $view->with(
                'logged_in_user_permissions',
                app(PermissionService::class)->all()
            );
        });
    }
}
