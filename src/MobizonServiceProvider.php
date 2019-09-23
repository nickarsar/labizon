<?php
namespace Labizon;

use Illuminate\Support\ServiceProvider;

class MobizonServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MobizonClient::class, function ($app) {
            return new Client(
                config('services.mobizon.key'),
                config('services.mobizon.domain')
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}