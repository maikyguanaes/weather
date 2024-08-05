<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

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
        RateLimiter::for(
            'api',
            function (Request $request) {
                if (app()->environment('production')) {
                    return Limit::perMinute(env('RATE_LIMITE_API', 5))->by($request->user()?->id ?: $request->ip());
                }

                return Limit::perMinute(env('RATE_LIMITE_API_TEST', 9999))->by($request->user()?->id ?: $request->ip());
            }
        );
    }
}
