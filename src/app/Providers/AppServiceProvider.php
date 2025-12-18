<?php

namespace App\Providers;

use App\Services\MenuService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.admin', function ($view) {
            if (auth()->check()) {
                $menus = app(MenuService::class)
                    ->getForUser(auth()->user());

                $view->with('adminMenus', $menus);
            }
        });
    }
}
