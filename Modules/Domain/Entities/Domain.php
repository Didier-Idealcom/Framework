<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="Domain",
 *     description="Domain model"
 * )
 */
class Domain extends Model
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
     *     title="Title",
     *     description="Title",
     *     type="string"
     * )
     *
     * @var string
     */
    private $title;

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
     *     title="Folder",
     *     description="Folder",
     *     type="string"
     * )
     *
     * @var string
     */
    private $folder;

    /**
     * @OA\Property(
     *     title="Analytics",
     *     description="Analytics",
     *     type="string"
     * )
     *
     * @var string
     */
    private $analytics;

    /**
     * @OA\Property(
     *     title="Search console",
     *     description="Search console",
     *     type="string"
     * )
     *
     * @var string
     */
    private $search_console;

    /**
     * @OA\Property(
     *     title="Google Maps",
     *     description="Google Maps",
     *     type="string"
     * )
     *
     * @var string
     */
    private $google_maps;

    /**
     * @OA\Property(
     *     title="Maintenance start",
     *     description="Maintenance start",
     *     type="string",
     *     format="date-time",
     *     example="2020-01-27 17:50:45"
     * )
     *
     * @var \DateTime
     */
    private $maintenance_start;

    /**
     * @OA\Property(
     *     title="Maintenance end",
     *     description="Maintenance end",
     *     type="string",
     *     format="date-time",
     *     example="2020-01-27 17:50:45"
     * )
     *
     * @var \DateTime
     */
    private $maintenance_end;

    /**
     * @OA\Property(
     *     title="Maintenance message",
     *     description="Maintenance message",
     *     type="string"
     * )
     *
     * @var string
     */
    private $maintenance_message;

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

    /**
     * Get the languages for the domain.
     */
    public function languages()
    {
        return $this->hasMany('Modules\Domain\Entities\DomainLanguage');
    }
}
