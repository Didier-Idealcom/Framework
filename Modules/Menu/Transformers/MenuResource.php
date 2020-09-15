<?php

namespace Modules\Menu\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="MenuResource",
 *     description="Menu resource",
 *     @OA\Xml(
 *         name="MenuResource"
 *     )
 * )
 */
class MenuResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \Modules\Menu\Entities\Menu[]
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
            'code' => $this->code,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'translations' => $this->getTranslationsArray()
        ];
    }
}
