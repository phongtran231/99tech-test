<?php

namespace Modules\Products\Providers;

use Illuminate\Support\ServiceProvider;

class ProductsServiceProvider extends ServiceProvider
{

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'products';

    /**
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(ServiceRegisterProvider::class);
        $this->app->register(RepositoryRegisterProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => app()->basePath() . '/config/' . $this->moduleNameLower . '.php'
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', $this->moduleNameLower
        );
    }

    /**
     * @return void
     */
    public function registerViews()
    {
        $sourcePath = __DIR__ . '/../Resources/views';

        $this->loadViewsFrom($sourcePath, $this->moduleNameLower);
    }
}
