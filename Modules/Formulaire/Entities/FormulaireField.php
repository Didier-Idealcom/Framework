<?php

namespace Modules\Formulaire\Entities;

use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

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
}
