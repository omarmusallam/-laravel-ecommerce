<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\CurrencyConverter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('currency.converter', function () {
            return new CurrencyConverter(config('services.currency_converter.api_key'));
        });

        $this->app->bind('stripe.client', function () {
            return new \Stripe\StripeClient(config('services.stripe.secret_key'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();

        Paginator::useBootstrapFour();

        $settings = Setting::first();
        $user = Auth::user();

        view()->share('user', $user);
        view()->share('settings', $settings);

        // Validator::extend('filter', function($attribute, $value, $params) {
        //     return ! in_array(strtolower($value), $params);
        // }, 'The value is prohipted!');
    }
}