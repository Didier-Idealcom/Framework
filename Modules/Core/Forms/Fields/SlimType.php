<?php

namespace Modules\Core\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class SlimType extends FormField
{
    protected function getTemplate()
    {
        return 'fields.slim';
    }
}
