<?php

namespace Modules\Core\Repositories;

abstract class ResourceRepository
{
    protected $model;

    public function load($n)
    {
        return $this->model->paginate($n);
    }

    public function store(Array $inputs)
    {
        return $this->model->create($inputs);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, Array $inputs)
    {
        $this->find($id)->update($inputs);
    }

    public function destroy($id)
    {
        $this->find($id)->delete();
    }
}
