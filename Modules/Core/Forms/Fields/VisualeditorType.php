<?php

namespace Modules\Core\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\FormField;

class VisualeditorType extends FormField
{
    protected function getTemplate()
    {
        return 'fields.visual-editor';
    }
}
