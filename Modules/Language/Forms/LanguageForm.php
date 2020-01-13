<?php

namespace Modules\Language\Forms;

use Modules\Core\Forms\CoreForm;

class LanguageForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.languages.update', $this->getModel()->id);
            $method = 'PUT';
        } else {
            $url = route('admin.languages.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form'
        ];

        $this
            ->add('alpha2', 'text', [
                'label' => 'Alpha 2',
                'rules' => !$this->getModel() ? 'required|size:2|unique:languages' : 'required|size:2'
            ])
            ->add('name', 'text', [
                'label' => 'Nom',
                'rules' => 'required'
            ])
            ->add('format_date_small', 'text', [
                'label' => 'Format date court',
                'rules' => 'required'
            ])
            ->add('format_date_long', 'text', [
                'label' => 'Format date long',
                'rules' => 'required'
            ])
            ->add('format_date_time', 'text', [
                'label' => 'Format date time',
                'rules' => 'required'
            ]);

        parent::buildForm();
    }
}
