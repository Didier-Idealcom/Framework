<?php

namespace Modules\Core\Repositories;

interface RepositoryInterface
{
    public function getModel();

    public function setModel($model);

    public function all();

    public function load($n);

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function switch($id, $field = 'active');

    public function delete($id);
}
