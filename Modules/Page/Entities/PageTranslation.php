<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="PageTranslation",
 *     description="PageTranslation model",
 *
 *     @OA\Property(
 *         property="title",
 *         title="Title",
 *         description="Title",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         title="Content",
 *         description="Content",
 *         type="string"
 *     )
 * )
 */
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

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['page'];

    public $timestamps = false;

    public function page()
    {
        return $this->belongsTo('Modules\Page\Entities\Page');
    }
}
