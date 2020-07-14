<?php

namespace Modules\Formulaire\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class FormulaireFieldResource extends JsonResource
{
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
