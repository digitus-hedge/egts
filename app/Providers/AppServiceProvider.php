<?php

namespace App\Providers;

use App\Models\ContactBanner;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer(['web.layout.header', 'web.layout.footer'], function ($view) {
            $view->with('contactBanner', ContactBanner::first());
        });

        View::composer('web.layout.footer', function ($view) {
            $view->with('footerServices', Service::latest()->take(7)->get());
        });
    }
}
