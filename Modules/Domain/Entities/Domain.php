<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\HasUrlPresenter;

/**
 * @OA\Schema(
 *     title="Domain",
 *     description="Domain model",
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
 *         property="title",
 *         title="Title",
 *         description="Title",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         title="Name",
 *         description="Name",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="folder",
 *         title="Folder",
 *         description="Folder",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="analytics",
 *         title="Analytics",
 *         description="Analytics",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="google_maps_api_key",
 *         title="Google Maps API key",
 *         description="Google Maps API key",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="maintenance_start",
 *         title="Maintenance start",
 *         description="Maintenance start",
 *         type="string",
 *         format="date-time",
 *         example="2020-01-27 17:50:45"
 *     ),
 *     @OA\Property(
 *         property="maintenance_end",
 *         title="Maintenance end",
 *         description="Maintenance end",
 *         type="string",
 *         format="date-time",
 *         example="2020-01-27 17:50:45"
 *     ),
 *     @OA\Property(
 *         property="maintenance_message",
 *         title="Maintenance message",
 *         description="Maintenance message",
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
class Domain extends Model
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

    /**
     * Get the languages for the domain.
     */
    public function languages()
    {
        return $this->hasMany('Modules\Domain\Entities\DomainLanguage');
    }
}
