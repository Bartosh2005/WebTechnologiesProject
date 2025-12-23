<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Determine the desired locale: route param -> cookie -> config
            $locale = $request->route('locale') ?? $request->cookie('locale') ?? config('app.locale');
            // Ensure locale is valid
            if ($locale && array_key_exists($locale, config('app.available_locales', []))) {
                return route('login', ['locale' => $locale]);
            }

            // Fallback to named login route without locale
            return route('login');
        }
    }
}
