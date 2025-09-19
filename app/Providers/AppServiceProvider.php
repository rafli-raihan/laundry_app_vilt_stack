<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use IIluminate\Support\Facades\Auth;
use Inertia\Inertia;

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
        Inertia::share([
            'auth' => [
                'user' => fn() => Auth::user(),
            ],
        ]);
    }
}
