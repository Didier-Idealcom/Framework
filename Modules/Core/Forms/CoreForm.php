<?php

namespace Modules\Core\Forms;

use Kris\LaravelFormBuilder\Form;

class CoreForm extends Form
{
    public function buildForm()
    {
        $locales = [];
        $languages = session()->get('languages');
        foreach ($languages as $language) {
            $locales[$language->alpha2] = $language->name;
        }

        foreach ($this->getFields() as $field) {
            $type = $field->getType();
            $name = $field->getName();

            // Grapes JS
            if ($type == 'grapesjs') {
                $field->setOption('attr.class', $field->getOption('attr.class').' d-none');
            }

            $options = $field->getOptions();

            // Multi-langue
            if (isset($options['translatable']) && $options['translatable'] === true) {
                $attr_class = $options['attr']['class'];
                if (! empty($options['url_show'])) {
                    $url_show = $options['url_show'];
                }
                foreach ($locales as $locale => $libelle) {
                    $options['attr']['class'] = $attr_class.' input-multilangue lang-'.$locale;
                    $options['attr']['data-lang'] = $locale;
                    $options['attr']['data-lang-libelle'] = $libelle;
                    if (! empty($options['url_show'])) {
                        $options['url_show'] = $url_show.'?lang='.$locale;
                    }
                    $options['value'] = ($this->getModel() && $this->getModel()->id && ! empty($this->getModel()->translate($locale)->$name)) ? $this->getModel()->translate($locale)->$name : '';
                    $this->addBefore($name, $locale.'_'.$name, $field->getType(), $options);
                }
                $this->remove($name);
            }
        }
    }
}
