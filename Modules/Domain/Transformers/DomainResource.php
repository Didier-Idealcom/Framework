<?php

namespace Modules\Domain\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="DomainResource",
 *     description="Domain resource",
 *     @OA\Xml(
 *         name="DomainResource"
 *     )
 * )
 */
class DomainResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \Modules\Domain\Entities\Domain[]
     */
    private $data;

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id' => $this->id,
            'active' => $this->active,
            'title' => $this->title,
            'name' => $this->name,
            'folder' => $this->folder,
            'analytics' => $this->analytics,
            'maintenance_start' => $this->maintenance_start,
            'maintenance_end' => $this->maintenance_end,
            'maintenance_message' => $this->maintenance_message,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at
        ];
    }
}
