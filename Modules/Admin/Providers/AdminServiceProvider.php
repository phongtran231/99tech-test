<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'admin';

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
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
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
