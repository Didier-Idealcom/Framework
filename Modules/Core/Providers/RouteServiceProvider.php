<?php

namespace Modules\Core\Providers;

use Modules\Core\Providers\RoutingServiceProvider as CoreRoutingServiceProvider;

class RouteServiceProvider extends CoreRoutingServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Modules\Core\Http\Controllers';

    /**
     * @return string
     */
    protected function getFrontendRoutes()
    {
        return __DIR__.'/../Routes/web_frontend.php';
    }

    /**
     * @return string
     */
    protected function getBackendRoutes()
    {
        return __DIR__.'/../Routes/web_backend.php';
    }

    /**
     * @return string
     */
    protected function getApiRoutes()
    {
        return __DIR__.'/../Routes/api.php';
    }
}
