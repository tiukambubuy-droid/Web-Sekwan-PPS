<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

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
        view()->composer('*', function ($view) {
            $menus = Menu::with(['items' => function ($q) {
                $q->where('is_active', true)->orderBy('order');
            }])
                ->where('is_active', true)
                ->orderBy('order')
                ->get();

            $view->with('menus', $menus);
        });
    }
}
