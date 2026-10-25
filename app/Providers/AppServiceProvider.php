<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        View::share('siteSetting', SiteSetting::first());

        View::composer('partials.user-header', function ($view) {
            if (auth()->check()) {
                $view->with('notifikasiBelumDibaca', auth()->user()->unreadNotifications()->count());
                $view->with('notifikasiTerbaru', auth()->user()->notifications()->latest()->take(8)->get());
            }
        });
    }
}
