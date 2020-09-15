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
 * )
 */
class Menuitem extends Model implements Permalinkable
{
    use Translatable, HasUrlPresenter, HasPermalink;

    /**
     * @OA\Property(
     *     property="id",
     *     ref="#/components/schemas/BaseModel/properties/id")
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Menu ID",
     *     description="Menu ID",
     *     type="integer",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $menu_id;

    /**
     * @OA\Property(
     *     title="Active",
     *     description="Active",
     *     type="string",
     *     enum={"Y","N"}
     * )
     *
     * @var string
     */
    private $active;

    /**
     * @OA\Property(
     *     title="Gabarit",
     *     description="Gabarit",
     *     type="string"
     * )
     *
     * @var string
     */
    private $gabarit;

    /**
     * @OA\Property(
     *     title="BG",
     *     description="Bord gauche",
     *     type="integer",
     *     format="int64",
     *     example=1
     * )
     *
     * @var string
     */
    private $bg;

    /**
     * @OA\Property(
     *     title="BD",
     *     description="Bord droit",
     *     type="integer",
     *     format="int64",
     *     example=1
     * )
     *
     * @var string
     */
    private $bd;

    /**
     * @OA\Property(
     *     title="Niveau",
     *     description="Niveau",
     *     type="integer",
     *     format="int64",
     *     example=1
     * )
     *
     * @var string
     */
    private $niveau;

    /**
     * @OA\Property(
     *     title="Parent ID",
     *     description="Parent ID",
     *     type="integer",
     *     format="int64",
     *     example=1
     * )
     *
     * @var string
     */
    private $parent_id;

    /**
     * @OA\Property(
     *     title="Visible",
     *     description="Visible",
     *     type="string",
     *     enum={"Y","N"}
     * )
     *
     * @var string
     */
    private $visible;

    /**
     * @OA\Property(
     *     title="Cliquable",
     *     description="Cliquable",
     *     type="string",
     *     enum={"Y","N"}
     * )
     *
     * @var string
     */
    private $cliquable;

    /**
     * @OA\Property(
     *     title="Format",
     *     description="Format",
     *     type="string",
     *     enum={"submenu","big_submenu"}
     * )
     *
     * @var string
     */
    private $format;

    /**
     * @OA\Property(
     *     property="created_at",
     *     ref="#/components/schemas/BaseModel/properties/created_at")
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     property="updated_at",
     *     ref="#/components/schemas/BaseModel/properties/updated_at")
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

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
