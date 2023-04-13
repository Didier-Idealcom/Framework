<?php

namespace Modules\Email\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Factory;
use Modules\Core\Traits\CanPublishConfiguration;

class EmailServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerViews();
        $this->registerTranslations();
        $this->registerFactories();
        $this->registerMigrations();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        //$this->publishes([__DIR__.'/../Config/config.php' => config_path('email.php')], 'config');
        //$this->mergeConfigFrom(__DIR__.'/../Config/config.php', 'email');
        $this->publishConfig('email', 'config');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $sourcePath = __DIR__.'/../Resources/views';
        $viewPath = resource_path('views/modules/email');

        $this->publishes([$sourcePath => $viewPath], 'views');
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/email';
        }, Config::get('view.paths')), [$sourcePath]), 'email');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $sourcePath = __DIR__.'/../Lang';
        $langPath = lang_path('modules/email');

        $this->publishes([$sourcePath => $langPath], 'lang');
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'email');
        } else {
            $this->loadTranslationsFrom($sourcePath, 'email');
        }
    }

    /**
     * Register factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__.'/../Database/factories');
        }
    }

    /**
     * Register migrations.
     *
     * @return void
     */
    public function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
