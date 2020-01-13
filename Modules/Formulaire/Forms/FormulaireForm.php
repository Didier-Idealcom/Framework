<?php

namespace Modules\Formulaire\Forms;

use Modules\Core\Forms\CoreForm;

class FormulaireForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.formulaires.update', $this->getModel()->id);
            $method = 'PUT';
        } else {
            $url = route('admin.formulaires.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form'
        ];

        $this
            ->add('code', 'text', [
                'label' => 'Code',
                'rules' => 'required'
            ])
            ->add('title', 'text', [
                'label' => 'Titre',
                'rules' => 'required',
                'translatable' => true
            ])
            ->add('resume', 'textarea', [
                'label' => 'Accroche',
                'rules' => 'required',
                'translatable' => true
            ])
            ->add('tracking', 'textarea', [
                'label' => 'Code de tracking',
                'rules' => ''
            ]);

        parent::buildForm();
    }
}
