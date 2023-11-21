<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Repositories\ModelRepository;
use Modules\Core\Repositories\RepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(RepositoryInterface::class, ModelRepository::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm', 'App\Http\Livewire\CustomUpdateProfileInformationForm');
    }
}
