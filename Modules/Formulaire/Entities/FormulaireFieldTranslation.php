<?php

namespace Modules\Formulaire\Entities;

use Illuminate\Database\Eloquent\Model;

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

    public $timestamps = false;
}
