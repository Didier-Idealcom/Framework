<?php

namespace Modules\Formulaire\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="Formulaire",
 *     description="Formulaire model",
 *
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
 *         property="tracking",
 *         title="Tracking",
 *         description="Tracking",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         ref="#/components/schemas/BaseModel/properties/created_at")
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         ref="#/components/schemas/BaseModel/properties/updated_at")
 *     )
 * )
 */
class Formulaire extends Model
{
    use HasUrlPresenter, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['active', 'code', 'tracking'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['title', 'resume'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'url_backend', 'url_api'];

    /**
     * Get the FormulaireField records associated with the Formulaire.
     */
    public function formulaire_fields()
    {
        return $this->hasMany('Modules\Formulaire\Entities\FormulaireField');
    }
}
