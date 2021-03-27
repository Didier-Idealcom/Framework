<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="PageTranslation",
 *     description="PageTranslation model",
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

    public $timestamps = false;
}
