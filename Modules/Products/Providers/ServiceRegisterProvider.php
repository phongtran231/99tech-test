<?php

namespace Modules\Products\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Products\Services\ProductService\IProductService;
use Modules\Products\Services\ProductService\ProductService;

class ServiceRegisterProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->singleton(IProductService::class, ProductService::class);
    }
}