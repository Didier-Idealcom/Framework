<?php

namespace Modules\Core\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

abstract class RoutingServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = '';

    /**
     * @return string
     */
    abstract protected function getFrontendRoutes();

    /**
     * @return string
     */
    abstract protected function getBackendRoutes();

    /**
     * @return string
     */
    abstract protected function getApiRoutes();

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {
            $this->loadApiRoutes($router);
        });

        $router->group([
            'namespace' => $this->namespace,
            'prefix' => '',
            'middleware' => [],
        ], function (Router $router) {
            $this->loadBackendRoutes($router);
            $this->loadFrontendRoutes($router);
        });
    }

    private function loadFrontendRoutes(Router $router)
    {
        $frontend = $this->getFrontendRoutes();

        if ($frontend && file_exists($frontend)) {
            $router->group([
                'middleware' => config('framework.core.config.middleware.frontend', []),
            ], function () use ($frontend) {
                require $frontend;
            });
        }
    }

    private function loadBackendRoutes(Router $router)
    {
        $backend = $this->getBackendRoutes();

        if ($backend && file_exists($backend)) {
            $router->group([
                'namespace' => 'Admin',
                'as' => config('framework.core.config.prefix-backend').'.',
                'prefix' => config('framework.core.config.prefix-backend'),
                'middleware' => config('framework.core.config.middleware.backend', []),
            ], function () use ($backend) {
                require $backend;
            });
        }
    }

    private function loadApiRoutes(Router $router)
    {
        $api = $this->getApiRoutes();

        if ($api && file_exists($api)) {
            $router->group([
                'namespace' => 'Api',
                'as' => config('framework.core.config.prefix-api').'.',
                'prefix' => config('framework.core.config.prefix-api'),
                'middleware' => config('framework.core.config.middleware.api', []),
            ], function () use ($api) {
                require $api;
            });
        }
    }
}
