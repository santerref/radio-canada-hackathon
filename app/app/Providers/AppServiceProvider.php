<?php

namespace App\Providers;

use App\Elastic\Factory;
use App\RadioCanada\APIs\Neuro;
use App\RadioCanada\APIs\SiteSearch;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('elastic', function ($app) {
            return new Client([
                'base_uri' => config('elastic.host'),
                'timeout' => 5,
            ]);
        });

        $this->app->singleton('guzzle', function ($app) {
            return new Client([
                'base_uri' => config('radiocanada.base_uri'),
                'timeout' => 5,
            ]);
        });

        $this->app->singleton('sitesearch', function ($app) {
            return new SiteSearch(config('radiocanada.client_key'));
        });

        $this->app->singleton('neuro', function ($app) {
            return new Neuro(config('radiocanada.client_key'));
        });

        $this->app->singleton('factory', function ($app) {
            return new Factory();
        });
    }
}
