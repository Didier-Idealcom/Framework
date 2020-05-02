<?php

namespace Modules\Core\Contracts;

interface Permalinkable
{
    /**
     * Get the options for the sluggable package.
     *
     * @return array
     */
    public function permalinkSlug(): array;
}
