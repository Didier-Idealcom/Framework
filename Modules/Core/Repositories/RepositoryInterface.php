<?php

namespace Modules\Core\Repositories;

interface RepositoryInterface
{
    public function load($n);

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
