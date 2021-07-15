<?php

namespace App\Providers;

use App\Models\Portfolio\Portfolio;
use App\Models\Portfolio\Post;
use App\Observers\PortfolioObserver;
use App\Observers\PostObserver;
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
        Post::observe(PostObserver::class);
    }
}
