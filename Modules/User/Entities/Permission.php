<?php

namespace Modules\User\Entities;

use Spatie\Permission\Models\Permission as BasePermission;
use Modules\Core\Traits\HasUrlPresenter;

class Permission extends BasePermission
{
    use HasUrlPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'guard_name'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'url_backend', 'url_api'];
}
