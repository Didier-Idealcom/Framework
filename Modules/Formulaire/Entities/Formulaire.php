<?php

namespace Modules\Formulaire\Entities;

use \Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="Formulaire",
 *     description="Formulaire model",
 * )
 */
class Formulaire extends Model
{
    use Translatable, HasUrlPresenter;

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
     *     title="Code",
     *     description="Code",
     *     type="string"
     * )
     *
     * @var string
     */
    private $code;

    /**
     * @OA\Property(
     *     title="Tracking",
     *     description="Tracking",
     *     type="string"
     * )
     *
     * @var string
     */
    private $tracking;

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
