<?php

namespace Modules\Formulaire\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="FormulaireTranslation",
 *     description="FormulaireTranslation model",
 *
 *     @OA\Property(
 *         property="title",
 *         title="Title",
 *         description="Title",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="resume",
 *         title="Resume",
 *         description="Resume",
 *         type="string"
 *     )
 * )
 */
class FormulaireTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'formulaires_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'resume'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['formulaire'];

    public $timestamps = false;

    public function formulaire()
    {
        return $this->belongsTo('Modules\Formulaire\Entities\Formulaire');
    }
}
