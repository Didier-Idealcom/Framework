<?php

namespace Modules\User\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Repositories\ResourceRepository;

class UserRepository extends ResourceRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(Array $inputs)
    {
    	if (!empty($inputs['password'])) {
    		$inputs['password'] = Hash::make($inputs['password']);
    	}
        return $this->model->create($inputs);
    }

    public function update($id, Array $inputs)
    {
    	if (!empty($inputs['password'])) {
    		$inputs['password'] = Hash::make($inputs['password']);
    	} else {
    		unset($inputs['password']);
    	}
        $this->find($id)->update($inputs);
    }
}
