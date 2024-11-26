<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Brian2694\Toastr\Facades\Toastr;

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
        Toastr::useVite();
    }
}
