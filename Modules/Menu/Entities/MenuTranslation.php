<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="MenuTranslation",
 *     description="MenuTranslation model",
 *     @OA\Property(
 *         property="title",
 *         title="Title",
 *         description="Title",
 *         type="string"
 *     )
 * )
 */
class MenuTranslation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'menus_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    public $timestamps = false;
}
