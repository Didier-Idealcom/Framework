<?php

namespace Modules\Menu\Entities;

use \Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="Menu",
 *     description="Menu model",
 *     @OA\Property(
 *         property="id",
 *         ref="#/components/schemas/BaseModel/properties/id")
 *     ),
 *     @OA\Property(
 *         property="active",
 *         title="Active",
 *         description="Active",
 *         type="string",
 *         enum={"Y","N"}
 *     ),
 *     @OA\Property(
 *         property="code",
 *         title="Code",
 *         description="Code",
 *         type="string"
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
 *         description="Menu translations",
 *         type="array",
 *         @OA\Items(
 *             ref="#/components/schemas/MenuTranslation"
 *         )
 *     )
 * )
 */
class Menu extends Model
{
    use Translatable, HasUrlPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['active', 'code'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['title'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'url_backend', 'url_api'];

    /**
     * Get the Menuitem records associated with the Menu.
     */
    public function menuitems()
    {
        return $this->hasMany('Modules\Menu\Entities\Menuitem');
    }
}
