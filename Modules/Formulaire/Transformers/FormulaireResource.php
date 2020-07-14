<?php

namespace Modules\Formulaire\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class FormulaireResource extends JsonResource
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
            'active' => $this->active,
            'code' => $this->code,
            'tracking' => $this->tracking,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at
        ];
    }
}
