<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pages_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content'];

    public $timestamps = false;
}
