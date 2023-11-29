<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CoreCrudRepositoryInterface
{
    public function getModel(): Model;

    public function setModel(Model $model);

    public function all(): Collection;

    public function paginate($n): Collection;

    public function find(int $id): Model;

    public function create(array $data): Model;

    public function update(int $id, array $data): bool;

    public function delete(int $id): ?bool;
}
