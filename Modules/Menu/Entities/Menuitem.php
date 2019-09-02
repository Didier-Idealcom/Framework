<?php

namespace Modules\Menu\Entities;

use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

class Menuitem extends Model
{
    use Translatable, HasUrlPresenter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menuitems';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['menu_id', 'active', 'bg', 'bd', 'niveau', 'parents_id', 'gabarit', 'visible', 'cliquable', 'format'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['title_menu', 'title_page', 'bandeau', 'link', 'target'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'url_backend', 'url_api'];
}
