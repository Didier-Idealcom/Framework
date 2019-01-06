<?php

namespace Modules\Formulaire\Entities;

use Illuminate\Database\Eloquent\Model;

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

    public $timestamps = false;
}
