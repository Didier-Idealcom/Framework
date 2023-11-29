<?php

namespace Modules\Page\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="PageResource",
 *     description="Page resource",
 *
 *     @OA\Property(
 *         property="data",
 *         title="Data",
 *         description="Data wrapper",
 *         type="array",
 *
 *         @OA\Items(
 *             ref="#/components/schemas/Page"
 *         )
 *     )
 * )
 */
class PageResource extends JsonResource
{
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
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
        ];
    }
}
