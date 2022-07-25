<?php

namespace App\Providers;

use App\repositories\BaseRepository;
use App\repositories\CategoryRepository;
use App\repositories\CategoryRepositoryInterface;
use App\repositories\EloquentRepositoryInterface;
use App\repositories\ProductRepository;
use App\repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class,BaseRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
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
