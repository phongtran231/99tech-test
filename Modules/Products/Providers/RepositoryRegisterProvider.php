<?php

namespace Modules\Products\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Products\Repositories\ProductImageRepository\IProductImageRepository;
use Modules\Products\Repositories\ProductImageRepository\ProductImageRepository;
use Modules\Products\Repositories\ProductRepository\IProductRepository;
use Modules\Products\Repositories\ProductRepository\ProductRepository;

class RepositoryRegisterProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(IProductRepository::class, ProductRepository::class);
        $this->app->singleton(IProductImageRepository::class, ProductImageRepository::class);
    }
}