<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="MenuTranslation",
 *     description="MenuTranslation model",
 * )
 */
class MenuTranslation extends Model
{
    /**
     * @OA\Property(
     *     title="Title",
     *     description="Title",
     *     type="string"
     * )
     *
     * @var string
     */
    private $title;

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
