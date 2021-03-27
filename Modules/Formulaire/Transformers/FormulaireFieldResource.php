<?php

namespace Modules\Formulaire\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="FormulaireFieldResource",
 *     description="FormulaireField resource",
 *     @OA\Property(
 *         property="data",
 *         title="Data",
 *         description="Data wrapper",
 *         type="array",
 *         @OA\Items(
 *             ref="#/components/schemas/FormulaireField"
 *         )
 *     )
 * )
 */
class FormulaireFieldResource extends JsonResource
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
            'formulaire_id' => $this->formulaire_id,
            'active' => $this->active,
            'order' => $this->order,
            'code' => $this->code,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at
        ];
    }
}
