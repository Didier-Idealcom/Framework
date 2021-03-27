<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="Language",
 *     description="Language model",
 *     @OA\Property(
 *         property="id",
 *         ref="#/components/schemas/BaseModel/properties/id")
 *     ),
 *     @OA\Property(
 *         property="active",
 *         title="Active",
 *         description="Active",
 *         type="string",
 *         enum={"Y","N"}
 *     ),
 *     @OA\Property(
 *         property="alpha2",
 *         title="Alpha2",
 *         description="Alpha2",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="alpha3",
 *         title="Alpha3",
 *         description="Alpha3",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="locale",
 *         title="Locale",
 *         description="Locale",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         title="Name",
 *         description="Name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="format_date_small",
 *         title="Format date small",
 *         description="Format date small",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="format_date_long",
 *         title="Format date long",
 *         description="Format date long",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="format_date_time",
 *         title="Format date time",
 *         description="Format date time",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         ref="#/components/schemas/BaseModel/properties/created_at")
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         ref="#/components/schemas/BaseModel/properties/updated_at")
 *     )
 * )
 */
class Language extends Model
{
    use HasUrlPresenter;

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
}
