<?php

namespace Modules\Formulaire\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="FormulaireFieldTranslation",
 *     description="FormulaireFieldTranslation model",
 *
 *     @OA\Property(
 *         property="label_admin",
 *         title="Label admin",
 *         description="Label admin",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="label_front",
 *         title="Label front",
 *         description="Label front",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="placeholder",
 *         title="Placeholder",
 *         description="Placeholder",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="date_format",
 *         title="Date format",
 *         description="Date format",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="help",
 *         title="Help",
 *         description="Help",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="error",
 *         title="Error",
 *         description="Error",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="error_min",
 *         title="Error min",
 *         description="Error min",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="error_max",
 *         title="Error max",
 *         description="Error max",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="error_extension",
 *         title="Error extension",
 *         description="Error extension",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="error_filesize",
 *         title="Error filesize",
 *         description="Error filesize",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="error_dimension",
 *         title="Error dimension",
 *         description="Error dimension",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="error_date_format",
 *         title="Error date format",
 *         description="Error date format",
 *         type="string"
 *     )
 * )
 */
class FormulaireFieldTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'formulaires_fields_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['label_admin', 'label_front', 'placeholder', 'date_format', 'help', 'error', 'error_min', 'error_max', 'error_extension', 'error_filesize', 'error_dimension', 'error_date_format'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['formulaire_field'];

    public $timestamps = false;

    public function formulaireField()
    {
        return $this->belongsTo('Modules\Formulaire\Entities\FormulaireField');
    }
}
