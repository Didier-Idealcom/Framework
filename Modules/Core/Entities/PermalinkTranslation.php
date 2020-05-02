<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;

class PermalinkTranslation extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permalinks_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slug', 'full_path'];

    public $timestamps = false;

    /**
     * Get the permalink that owns the translation.
     */
    public function permalink()
    {
        return $this->belongsTo('Modules\Core\Entities\Permalink');
    }
}
