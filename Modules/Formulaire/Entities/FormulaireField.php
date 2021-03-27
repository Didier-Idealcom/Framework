<?php

namespace Modules\Formulaire\Entities;

use \Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="FormulaireField",
 *     description="FormulaireField model",
 *     @OA\Property(
 *         property="id",
 *         ref="#/components/schemas/BaseModel/properties/id")
 *     ),
 *     @OA\Property(
 *         property="formulaire_id",
 *         title="Formulaire ID",
 *         description="Formulaire ID",
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
 *         property="order",
 *         title="Order",
 *         description="Order",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="code",
 *         title="Code",
 *         description="Code",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="type",
 *         title="Type",
 *         description="Type",
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
class FormulaireField extends Model
{
    use Translatable, HasUrlPresenter;

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
