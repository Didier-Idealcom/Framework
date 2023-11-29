<?php

namespace Modules\Core\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="LanguageResource",
 *     description="Language resource",
 *
 *     @OA\Property(
 *         property="data",
 *         title="Data",
 *         description="Data wrapper",
 *         type="array",
 *
 *         @OA\Items(
 *             ref="#/components/schemas/Language"
 *         )
 *     )
 * )
 */
class LanguageResource extends JsonResource
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
            'alpha2' => $this->alpha2,
            'alpha3' => $this->alpha3,
            'locale' => $this->locale,
            'name' => $this->name,
            'format_date_small' => $this->format_date_small,
            'format_date_long' => $this->format_date_long,
            'format_date_time' => $this->format_date_time,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
        ];
    }
}
