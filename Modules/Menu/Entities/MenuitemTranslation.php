<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="MenuitemTranslation",
 *     description="MenuitemTranslation model",
 *     @OA\Property(
 *         property="title_menu",
 *         title="Title menu",
 *         description="Title menu",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="title_page",
 *         title="Title page",
 *         description="Title page",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="link",
 *         title="Link",
 *         description="Link",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="target",
 *         title="Target",
 *         description="Target",
 *         type="string"
 *     )
 * )
 */
class MenuitemTranslation extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menuitems_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title_menu', 'title_page', 'bandeau', 'link', 'target'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['menuitem'];

    public $timestamps = false;

    public function menuitem()
    {
        return $this->belongsTo('Modules\Menu\Entities\Menuitem');
    }
}
