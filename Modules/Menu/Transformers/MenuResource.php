<?php

namespace Modules\Menu\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="MenuResource",
 *     description="Menu resource",
 *
 *     @OA\Property(
 *         property="data",
 *         title="Data",
 *         description="Data wrapper",
 *         type="array",
 *
 *         @OA\Items(
 *             ref="#/components/schemas/Menu"
 *         )
 *     )
 * )
 */
class MenuResource extends JsonResource
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
            'translations' => $this->getTranslationsArray(),
        ];
    }
}
