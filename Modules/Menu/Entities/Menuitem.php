<?php

namespace Modules\Menu\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Contracts\Permalinkable;
use Modules\Core\Traits\HasUrlPresenter;
use Modules\Core\Traits\HasPermalink;

/**
 * @OA\Schema(
 *     title="Menuitem",
 *     description="Menuitem model",
 *     @OA\Property(
 *         property="id",
 *         ref="#/components/schemas/BaseModel/properties/id")
 *     ),
 *     @OA\Property(
 *         property="menu_id",
 *         title="Menu ID",
 *         description="Menu ID",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="active",
 *         title="Active",
 *         description="Active",
 *         type="string",
 *         enum={"Y","N"}
 *     ),
 *     @OA\Property(
 *         property="gabarit",
 *         title="Gabarit",
 *         description="Gabarit",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="bg",
 *         title="BG",
 *         description="Bord gauche",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="bd",
 *         title="BD",
 *         description="Bord droit",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="niveau",
 *         title="Niveau",
 *         description="Niveau",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="parent_id",
 *         title="Parent ID",
 *         description="Parent ID",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="visible",
 *         title="Visible",
 *         description="Visible",
 *         type="string",
 *         enum={"Y","N"}
 *     ),
 *     @OA\Property(
 *         property="cliquable",
 *         title="Cliquable",
 *         description="Cliquable",
 *         type="string",
 *         enum={"Y","N"}
 *     ),
 *     @OA\Property(
 *         property="format",
 *         title="Format",
 *         description="Format",
 *         type="string",
 *         enum={"submenu","big_submenu"}
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         ref="#/components/schemas/BaseModel/properties/created_at")
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         ref="#/components/schemas/BaseModel/properties/updated_at")
 *     ),
 *     @OA\Property(
 *         property="translations",
 *         title="Translations",
 *         description="Menuitem translations",
 *         type="array",
 *         @OA\Items(
 *             ref="#/components/schemas/MenuitemTranslation"
 *         )
 *     )
 * )
 */
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
