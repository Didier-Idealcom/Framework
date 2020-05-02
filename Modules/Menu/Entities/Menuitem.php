<?php

namespace Modules\Menu\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Contracts\Permalinkable;
use Modules\Core\Traits\HasUrlPresenter;
use Modules\Core\Traits\HasPermalink;

class Menuitem extends Model implements Permalinkable
{
    use Translatable, HasUrlPresenter, HasPermalink;

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

    /**
     * Get the Menu record associated with the Menuitem.
     */
    public function menu()
    {
        return $this->belongsTo('Modules\Menu\Entities\Menu');
    }

    /**
     * Get the options for the sluggable package.
     *
     * @return array
     */
    public function permalinkSlug(): array
    {
        return ['created_at', 'title_menu'];
    }
}
