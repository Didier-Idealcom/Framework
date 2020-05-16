<?php

namespace Modules\Core\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class GrapesjsType extends FormField
{
    protected function getTemplate()
    {
        return 'fields.grapesjs';
    }
}
