<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     @OA\Property(
 *         property="id",
 *         title="ID",
 *         description="ID",
 *         type="integer",
 *         format="int64",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         title="Created at",
 *         description="Initial creation timestamp",
 *         type="string",
 *         format="date-time",
 *         example="2020-01-27 17:50:45",
 *         readOnly="true"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         title="Updated at",
 *         description="Last update timestamp",
 *         type="string",
 *         format="date-time",
 *         example="2020-01-27 17:50:45",
 *         readOnly="true"
 *     ),
 *     @OA\Property(
 *         property="deleted_at",
 *         title="Deleted at",
 *         description="Soft delete timestamp",
 *         type="string",
 *         format="date-time",
 *         example="2020-01-27 17:50:45",
 *         readOnly="true"
 *     )
 * )
 */
abstract class BaseModel extends Model {}
