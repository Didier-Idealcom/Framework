<?php

namespace Modules\Core\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="DomainResource",
 *     description="Domain resource",
 *
 *     @OA\Property(
 *         property="data",
 *         title="Data",
 *         description="Data wrapper",
 *         type="array",
 *
 *         @OA\Items(
 *             ref="#/components/schemas/Domain"
 *         )
 *     )
 * )
 */
class DomainResource extends JsonResource
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @param  Request
     * @return array
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'active' => $this->active,
            'title' => $this->title,
            'name' => $this->name,
            'folder' => $this->folder,
            'analytics' => $this->analytics,
            'google_maps_api_key' => $this->google_maps_api_key,
            'maintenance_start' => $this->maintenance_start,
            'maintenance_end' => $this->maintenance_end,
            'maintenance_message' => $this->maintenance_message,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
        ];
    }
}
