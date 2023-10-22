<?php

namespace Modules\Core\Contracts;

interface Permalinkable
{
    /**
     * Get the options for the sluggable package.
     */
    public function permalinkSlug(): array;
}
