<?php

namespace Modules\Core\Traits;

use Modules\Core\Entities\Domain;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
