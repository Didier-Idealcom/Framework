<?php

namespace Modules\Formulaire\Forms;

use Modules\Core\Forms\CoreForm;

class FormulaireFieldForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.formulaires_fields.update', $this->getModel()->id);
            $method = 'PUT';
        } else {
            $url = route('admin.formulaires_fields.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url
        ];

        $this
            ->add('formulaire_id', 'entity', [
                'label' => 'Formulaire',
                'rules' => 'required',
                'class' => 'Modules\Formulaire\Entities\FormulaireTranslation',
                'property_key' => 'formulaire_id',
                'property' => 'title'
            ])
            ->add('code', 'text', [
                'label' => 'Code',
                'rules' => 'required'
            ])
            ->add('type', 'text', [
                'label' => 'Type',
                'rules' => 'required'
            ])
            ->add('label_admin', 'text', [
                'label' => 'Label admin',
                'rules' => 'required'
            ])
            ->add('label_front', 'text', [
                'label' => 'Label front',
                'rules' => 'required'
            ])
            ->add('placeholder', 'text', [
                'label' => 'Placeholder',
                'rules' => ''
            ])
            ->add('help', 'text', [
                'label' => 'Aide',
                'rules' => ''
            ])
            ->add('error', 'text', [
                'label' => 'Erreur',
                'rules' => 'required'
            ]);
    }
}
