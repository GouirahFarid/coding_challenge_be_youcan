<?php

namespace App\Providers;

use App\repositories\BaseRepository;
use App\repositories\CategoryRepository;
use App\repositories\CategoryRepositoryInterface;
use App\repositories\EloquentRepositoryInterface;
use App\repositories\ProductRepository;
use App\repositories\ProductRepositoryInterface;
use App\services\BaseService;
use App\services\CategoryService;
use App\services\CategoryServiceInterface;
use App\services\EloquentServiceInterface;
use App\services\ProductService;
use App\services\ProductServiceInterface;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentServiceInterface::class,BaseService::class);
        $this->app->bind(CategoryServiceInterface::class,CategoryService::class);
        $this->app->bind(ProductServiceInterface::class,ProductService::class);
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
