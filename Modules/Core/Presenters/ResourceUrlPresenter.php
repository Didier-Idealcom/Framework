<?php

namespace Modules\Core\Presenters;

class ResourceUrlPresenter
{
    protected $model_id;
    protected $env;
    protected $resource_name;

    public function __construct($model, $env = '')
    {
        $this->model_id = $model->id;
        $this->env = $env;
        $this->resource_name = strtolower((new \ReflectionClass($model))->getShortName()) . 's';
    }

    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return $this->$key();
        }

        return $this->$key;
    }

    private function getEnvPrefix($env)
    {
        return config('framework.core.config.prefix-' . $env);
    }

    public function show()
    {
        $route = $this->resource_name . '.show';
        if (!empty($this->env)) {
            return route($this->getEnvPrefix($this->env) . '.' . $route, $this->model_id);
        }
        return route($route, $this->model_id);
    }

    public function edit()
    {
        $route = $this->resource_name . '.edit';
        if (!empty($this->env)) {
            return route($this->getEnvPrefix($this->env) . '.' . $route, $this->model_id);
        }
        return route($route, $this->model_id);
    }

    public function update()
    {
        $route = $this->resource_name . '.update';
        if (!empty($this->env)) {
            return route($this->getEnvPrefix($this->env) . '.' . $route, $this->model_id);
        }
        return route($route, $this->model_id);
    }

    public function destroy()
    {
        $route = $this->resource_name . '.destroy';
        if (!empty($this->env)) {
            return route($this->getEnvPrefix($this->env) . '.' . $route, $this->model_id);
        }
        return route($route, $this->model_id);
    }
}
