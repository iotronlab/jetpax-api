<?php

namespace App\Providers;

use App\Models\Portfolio\Portfolio;
use App\Observers\PortfolioObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Portfolio::observe(PortfolioObserver::class);
    }
}
