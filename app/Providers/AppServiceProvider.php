<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

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
        // Set application locale from optional {locale} route parameter
        Route::matched(function ($event) {
            $locale = $event->route->parameter('locale');

            if ($locale && array_key_exists($locale, config('app.available_locales', []))) {
                app()->setLocale($locale);
            }
        });
    }
}
