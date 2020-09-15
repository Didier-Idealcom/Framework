<?php

namespace Modules\Formulaire\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="FormulaireFieldResource",
 *     description="FormulaireField resource",
 *     @OA\Xml(
 *         name="FormulaireFieldResource"
 *     )
 * )
 */
class FormulaireFieldResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \Modules\Formulaire\Entities\FormulaireField[]
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
