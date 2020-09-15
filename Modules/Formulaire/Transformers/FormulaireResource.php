<?php

namespace Modules\Formulaire\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="FormulaireResource",
 *     description="Formulaire resource",
 *     @OA\Xml(
 *         name="FormulaireResource"
 *     )
 * )
 */
class FormulaireResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \Modules\Formulaire\Entities\Formulaire[]
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
            'tracking' => $this->tracking,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at
        ];
    }
}
