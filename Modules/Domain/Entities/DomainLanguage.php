<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

class DomainLanguage extends Model
{
    use HasUrlPresenter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'domains_languages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = [];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url', 'url_backend', 'url_api'];

    /**
     * Get the domain that owns the domain language.
     */
    public function domain()
    {
        return $this->belongsTo('Modules\Domain\Entities\Domain');
    }

    /**
     * Get the language that owns the domain language.
     */
    public function language()
    {
        return $this->belongsTo('Modules\Language\Entities\Language');
    }
}
