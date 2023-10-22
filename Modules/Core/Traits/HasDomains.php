<?php

namespace Modules\Core\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Core\Entities\Domain;

trait HasDomains
{
    /**
     * A model may have multiple domains.
     */
    public function domains(): BelongsToMany
    {
        return $this->morphToMany(
            Domain::class,
            'model',
            'model_has_domains',
            'model_id',
            'domain_id'
        );
    }
}
