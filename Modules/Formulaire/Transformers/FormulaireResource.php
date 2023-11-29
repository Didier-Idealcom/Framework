<?php

namespace Modules\Formulaire\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="FormulaireResource",
 *     description="Formulaire resource",
 *
 *     @OA\Property(
 *         property="data",
 *         title="Data",
 *         description="Data wrapper",
 *         type="array",
 *
 *         @OA\Items(
 *             ref="#/components/schemas/Formulaire"
 *         )
 *     )
 * )
 */
class FormulaireResource extends JsonResource
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
            'code' => $this->code,
            'tracking' => $this->tracking,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
        ];
    }
}
