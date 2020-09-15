<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="Language",
 *     description="Language model"
 * )
 */
class Language extends Model
{
    use HasUrlPresenter;

    /**
     * @OA\Property(
     *     property="id",
     *     ref="#/components/schemas/BaseModel/properties/id")
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="Active",
     *     description="Active",
     *     type="string",
     *     enum={"Y","N"}
     * )
     *
     * @var string
     */
    private $active;

    /**
     * @OA\Property(
     *     title="Alpha2",
     *     description="Alpha2",
     *     type="string"
     * )
     *
     * @var string
     */
    private $alpha2;

    /**
     * @OA\Property(
     *     title="Alpha3",
     *     description="Alpha3",
     *     type="string"
     * )
     *
     * @var string
     */
    private $alpha3;

    /**
     * @OA\Property(
     *     title="Locale",
     *     description="Locale",
     *     type="string"
     * )
     *
     * @var string
     */
    private $locale;

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name",
     *     type="string"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="Format date small",
     *     description="Format date small",
     *     type="string"
     * )
     *
     * @var string
     */
    private $format_date_small;

    /**
     * @OA\Property(
     *     title="Format date long",
     *     description="Format date long",
     *     type="string"
     * )
     *
     * @var string
     */
    private $format_date_long;

    /**
     * @OA\Property(
     *     title="Format date time",
     *     description="Format date time",
     *     type="string"
     * )
     *
     * @var string
     */
    private $format_date_time;

    /**
     * @OA\Property(
     *     property="created_at",
     *     ref="#/components/schemas/BaseModel/properties/created_at")
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     property="updated_at",
     *     ref="#/components/schemas/BaseModel/properties/updated_at")
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

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
