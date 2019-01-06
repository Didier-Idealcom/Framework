<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

class Language extends Model
{
    use HasUrlPresenter;

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
}
