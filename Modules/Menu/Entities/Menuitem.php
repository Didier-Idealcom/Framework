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
    protected $fillable = ['menu_id', 'active', 'bg', 'bd', 'niveau', 'parent_id', 'gabarit', 'visible', 'cliquable', 'format'];

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
        return ['title_menu'];
    }

    public function loadRoot()
    {
        return Menuitem::where('menu_id', $this->menu_id)
                        ->where('bg', '<=', $this->bg)
                        ->where('bd', '>=', $this->bd)
                        ->where('niveau', 1)
                        ->orderBy('bg', 'asc')
                        ->get();
    }

    public function loadParents()
    {
        return Menuitem::where('menu_id', $this->menu_id)
                        ->where('bg', '<', $this->bg)
                        ->where('bd', '>', $this->bd)
                        ->where('niveau', '<', $this->niveau)
                        ->orderBy('bg', 'desc')
                        ->get();
    }

    public function loadParent()
    {
        return $this->loadParents()->first();
    }

    public function loadChilds($direct = false)
    {
        return Menuitem::where('menu_id', $this->menu_id)
                        ->where('bg', '>', $this->bg)
                        ->where('bd', '<', $this->bd)
                        ->when($direct, function($query) {
                            return $query->where('niveau', $this->niveau + 1);
                        })
                        ->orderBy('bg', 'asc')
                        ->get();
    }

    public function loadBrothers()
    {
        return Menuitem::where('menu_id', $this->menu_id)
                        ->where('parent_id', $this->parent_id)
                        ->where('niveau', $this->niveau)
                        ->where('id', '<>', $this->id)
                        ->orderBy('bg', 'asc')
                        ->get();
    }

    public function loadLeftBrother()
    {
        return Menuitem::where('menu_id', $this->menu_id)
                        ->where('parent_id', $this->parent_id)
                        ->where('niveau', $this->niveau)
                        ->where('bd', $this->bg - 1)
                        ->first();
    }

    public function loadRightBrother()
    {
        return Menuitem::where('menu_id', $this->menu_id)
                        ->where('parent_id', $this->parent_id)
                        ->where('niveau', $this->niveau)
                        ->where('bg', $this->bd + 1)
                        ->first();
    }

    /**
     * Booting the model.
     */
    public static function boot()
    {
        parent::boot();

        // https://sqlpro.developpez.com/cours/arborescence/
        static::created(function ($menuitem) {
            if ($menuitem->parent_id > 0) {
                $parent = self::find($menuitem->parent_id);

                // mode = FA (create menuitem in first position)
                /*self::where('menu_id', $menuitem->menu_id)
                    ->where('bd', '>', $parent->bg)
                    ->increment('bd', 2);

                self::where('menu_id', $menuitem->menu_id)
                    ->where('bg', '>', $parent->bg)
                    ->increment('bg', 2);

                $menuitem->bg     = $parent->bg + 1;
                $menuitem->bd     = $parent->bg + 2;
                $menuitem->niveau = $parent->niveau + 1;
                $menuitem->save();*/

                // mode = FC (create menuitem in last position)
                self::where('menu_id', $menuitem->menu_id)
                    ->where('bd', '>=', $parent->bd)
                    ->increment('bd', 2);

                self::where('menu_id', $menuitem->menu_id)
                    ->where('bg', '>', $parent->bd)
                    ->increment('bg', 2);

                $menuitem->bg     = $parent->bd;
                $menuitem->bd     = $parent->bd + 1;
                $menuitem->niveau = $parent->niveau + 1;
                $menuitem->saveQuietly();
            } else {
                $menuitem_ref = self::where('menu_id', $menuitem->menu_id)
                    ->where('niveau', 1)
                    ->orderBy('bg', 'desc')
                    ->first();

                // mode = PF (create menuitem in last position)
                if (!empty($menuitem_ref)) {
                    self::where('menu_id', $menuitem->menu_id)
                        ->where('bd', '>', $menuitem_ref->bd)
                        ->increment('bd', 2);

                    self::where('menu_id', $menuitem->menu_id)
                        ->where('bg', '>=', $menuitem_ref->bd)
                        ->increment('bg', 2);
                }

                $menuitem->bg     = !empty($menuitem_ref) ? $menuitem_ref->bd + 1 : 1;
                $menuitem->bd     = !empty($menuitem_ref) ? $menuitem_ref->bd + 2 : 2;
                $menuitem->niveau = 1;
                $menuitem->saveQuietly();
            }
        });

        static::deleted(function ($menuitem) {
            $delta = $menuitem->bd - $menuitem->bg + 1;

            self::where('menu_id', $menuitem->menu_id)
                ->where('bg', '>', $menuitem->bd)
                ->decrement('bg', $delta);

            self::where('menu_id', $menuitem->menu_id)
                ->where('bd', '>', $menuitem->bd)
                ->decrement('bd', $delta);
        });
    }
}
