<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Presenters\ResourceUrlPresenter;

class Language extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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
