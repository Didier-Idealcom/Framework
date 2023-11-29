<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Permission;

class RoleRepository extends CoreModelRepository
{
    // Create a new record in the database
    public function create(array $inputs): Model
    {
        $role = parent::create($inputs);

        $role->syncPermissions(request()->has('permission') ? Permission::whereIn('id', request()->get('permission'))->get() : []);

        return $role;
    }

    // Update record in the database
    public function update(int $id, array $inputs): bool
    {
        $updated = parent::update($id, $inputs);

        $role = $this->find($id);
        $role->syncPermissions(request()->has('permission') ? Permission::whereIn('id', request()->get('permission'))->get() : []);

        return $updated;
    }
}
