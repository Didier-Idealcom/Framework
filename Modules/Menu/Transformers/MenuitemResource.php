<?php

namespace Modules\Menu\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuitemResource extends JsonResource
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
            'menu_id' => $this->menu_id,
            'active' => $this->active,
            'gabarit' => $this->gabarit,
            'bg' => $this->bg,
            'bd' => $this->bd,
            'niveau' => $this->niveau,
            'parent_id' => $this->parent_id,
            'visible' => $this->visible,
            'cliquable' => $this->cliquable,
            'format' => $this->format,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at
        ];
    }
}
