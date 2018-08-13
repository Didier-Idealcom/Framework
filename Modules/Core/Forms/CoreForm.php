<?php

namespace Modules\Core\Forms;

use Kris\LaravelFormBuilder\Form;

class CoreForm extends Form
{
    public function buildForm()
    {
        $locales = array('fr', 'en');

//dd($this->getModel());
//dd($this->getFields());
        foreach ($this->getFields() as $field) {
//dd($field);
            $name = $field->getName();
            $options = $field->getOptions();
            if ($options['translatable']) {
                foreach ($locales as $locale) {
                    $options['attr']['class'] = 'form-control input-multilangue lang-' . $locale;
                    $options['attr']['data-lang'] = $locale;
                    $options['value'] = ($this->getModel() && $this->getModel()->id) ? $this->getModel()->translate($locale)->$name : '';
                    $this->addBefore($name, $locale . '_' . $name, $field->getType(), $options);
                }
                $this->remove($name);
            }
        }
//dd($this->getFields());
    }
}
