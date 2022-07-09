<?php

namespace Modules\Core\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\EntityType;

class PermissionType extends EntityType
{
    protected function getTemplate()
    {
        return 'fields.permission';
    }
}
