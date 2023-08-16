<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $settings = Setting::first();
            $user = Auth::user();
            $view->with('configurationData', $settings)->with('user', $user);
        });
    }
}