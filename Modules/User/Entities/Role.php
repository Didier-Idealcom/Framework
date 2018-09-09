<?php

namespace Modules\User\Entities;

use Spatie\Permission\Models\Role as BaseRole;
use Modules\Core\Presenters\ResourceUrlPresenter;

class Role extends BaseRole
{
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

    public function getUrlAttribute()
    {
        return new ResourceUrlPresenter($this);
    }

    public function getUrlBackendAttribute()
    {
        return new ResourceUrlPresenter($this, 'backend');
    }

    public function getUrlApiAttribute()
    {
        return new ResourceUrlPresenter($this, 'api');
    }
}
