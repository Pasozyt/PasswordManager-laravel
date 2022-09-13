<?php

namespace App\Providers;

use App\Services\Categories\CategorySearchService;
use App\Services\Search\SearchInterface;
use Illuminate\Pagination\Paginator;
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
        $this->app->bind(SearchInterface::class, CategorySearchService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // użycie Bootstrapa podczas paginacji 
        Paginator::useBootstrap();
    }
}
