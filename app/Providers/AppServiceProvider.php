<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Layanan;

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
        // Kirimkan data layanan ke partial navbar
        View::composer('pages.front._partials.navbar', function ($view) {
            $view->with('layananDropdown', Layanan::all());
        });
    }
}
