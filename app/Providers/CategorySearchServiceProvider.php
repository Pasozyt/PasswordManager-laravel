<?php

namespace App\Providers;

use App\Services\Categories\CategorySearchService;
use Illuminate\Support\ServiceProvider;

class CategorySearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CategorySearchService', function() {
            return new CategorySearchService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
