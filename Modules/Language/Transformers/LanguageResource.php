<?php

namespace Modules\Language\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="LanguageResource",
 *     description="Language resource",
 *     @OA\Xml(
 *         name="LanguageResource"
 *     )
 * )
 */
class LanguageResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \Modules\Language\Entities\Language[]
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
