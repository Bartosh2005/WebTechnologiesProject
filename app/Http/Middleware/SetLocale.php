<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Priority: route param -> cookie -> default config
        $locale = $request->route('locale') ?? $request->cookie('locale') ?? config('app.locale');

        if ($locale && array_key_exists($locale, config('app.available_locales', []))) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
