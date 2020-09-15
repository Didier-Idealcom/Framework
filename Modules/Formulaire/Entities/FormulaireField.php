<?php

namespace Modules\Formulaire\Entities;

use \Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="FormulaireField",
 *     description="FormulaireField model",
 * )
 */
class FormulaireField extends Model
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
     *     title="Formulaire ID",
     *     description="Formulaire ID",
     *     type="integer",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $formulaire_id;

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
     *     title="Order",
     *     description="Order",
     *     type="integer",
     *     format="int64",
     *     example=1
     * )
     *
     * @var string
     */
    private $order;

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
     *     title="Type",
     *     description="Type",
     *     type="string"
     * )
     *
     * @var string
     */
    private $type;

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
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'formulaires_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['formulaire_id', 'active', 'order', 'code', 'type'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['label_admin', 'label_front', 'placeholder', 'date_format', 'help', 'error', 'error_min', 'error_max', 'error_extension', 'error_filesize', 'error_dimension', 'error_date_format'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'url_backend', 'url_api'];

    /**
     * Get the Formulaire record associated with the FormulaireField.
     */
    public function formulaire()
    {
        return $this->belongsTo('Modules\Formulaire\Entities\Formulaire');
    }
}
