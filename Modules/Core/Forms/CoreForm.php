<?php

namespace Modules\Core\Forms;

use Kris\LaravelFormBuilder\Form;

class CoreForm extends Form
{
    public function buildForm()
    {
        $locales = array('fr' => 'Français', 'en' => 'Anglais');

//dd($this->getModel());
//dd($this->getFields());
        foreach ($this->getFields() as $field) {
//dd($field);
            $type = $field->getType();
            $name = $field->getName();

            // Grapes JS
            if ($type == 'grapesjs') {
                $field->setOption('attr.class', $field->getOption('attr.class') . ' d-none');
            }

            $options = $field->getOptions();

            // Multi-langue
            if (isset($options['translatable']) && $options['translatable'] === true) {
                $attr_class = $options['attr']['class'];
                foreach ($locales as $locale => $libelle) {
                    $options['attr']['class'] = $attr_class . ' input-multilangue lang-' . $locale;
                    $options['attr']['data-lang'] = $locale;
                    $options['attr']['data-lang-libelle'] = $libelle;
                    $options['value'] = ($this->getModel() && $this->getModel()->id) ? $this->getModel()->translate($locale)->$name : '';
                    $this->addBefore($name, $locale . '_' . $name, $field->getType(), $options);
                }
                $this->remove($name);
            }
        }
//dd($this->getFields());
    }
}
