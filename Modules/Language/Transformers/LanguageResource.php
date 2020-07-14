<?php

namespace Modules\Language\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
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
            'alpha2' => $this->alpha2,
            'alpha3' => $this->alpha3,
            'locale' => $this->locale,
            'name' => $this->name,
            'format_date_small' => $this->format_date_small,
            'format_date_long' => $this->format_date_long,
            'format_date_time' => $this->format_date_time,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at
        ];
    }
}
