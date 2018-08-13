<?php

namespace Modules\Page\Entities;

use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Presenters\ResourceUrlPresenter;

class Page extends Model
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['active'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['title', 'content'];

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
