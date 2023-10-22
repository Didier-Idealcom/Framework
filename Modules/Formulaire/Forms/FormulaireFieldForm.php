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
            $formulaire_id = $this->getModel()->formulaire_id;
        } else {
            $url = route('admin.formulaires_fields.store');
            $method = 'POST';
            if ($this->getRequest()->get('formulaire_id')) {
                $formulaire_id = $this->getRequest()->get('formulaire_id');
            } else {
                $formulaire = $this->getRequest()->route()->parameter('formulaire');
                $formulaire_id = $formulaire->id;
            }
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form',
        ];

        $this
            /*->add('formulaire_id', 'entity', [
                'label' => 'Formulaire',
                'rules' => 'required',
                'class' => 'Modules\Formulaire\Entities\FormulaireTranslation',
                'property_key' => 'formulaire_id',
                'property' => 'title'
            ])*/
            ->add('formulaire_id', 'hidden', [
                'rules' => 'required',
                'default_value' => $formulaire_id,
            ])
            ->add('code', 'text', [
                'label' => 'Code',
                'rules' => 'required',
            ])
            ->add('type', 'text', [
                'label' => 'Type',
                'rules' => 'required',
            ])
            ->add('label_admin', 'text', [
                'label' => 'Label admin',
                'rules' => 'required',
                'translatable' => true,
            ])
            ->add('label_front', 'text', [
                'label' => 'Label front',
                'rules' => 'required',
                'translatable' => true,
            ])
            ->add('placeholder', 'text', [
                'label' => 'Placeholder',
                'rules' => '',
                'translatable' => true,
            ])
            ->add('help', 'text', [
                'label' => 'Aide',
                'rules' => '',
                'translatable' => true,
            ])
            ->add('error', 'text', [
                'label' => 'Erreur',
                'rules' => 'required',
                'translatable' => true,
            ]);

        parent::buildForm();
    }
}
