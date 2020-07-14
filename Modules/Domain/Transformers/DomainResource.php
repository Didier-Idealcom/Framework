<?php

namespace Modules\Domain\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class DomainResource extends JsonResource
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
            'title' => $this->title,
            'name' => $this->name,
            'folder' => $this->folder,
            'analytics' => $this->analytics,
            'maintenance_start' => $this->maintenance_start,
            'maintenance_end' => $this->maintenance_end,
            'maintenance_message' => $this->maintenance_message,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at
        ];
    }
}
