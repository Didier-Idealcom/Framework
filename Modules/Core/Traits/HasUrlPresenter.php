<?php

namespace Modules\Core\Traits;

use Modules\Core\Presenters\ResourceUrlPresenter;

trait HasUrlPresenter
{
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
