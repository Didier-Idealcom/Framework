<?php

namespace Modules\Core\Repositories;

interface CoreTranslatableRepositoryInterface
{
    public function processTranslations(array $inputs): array;
}
