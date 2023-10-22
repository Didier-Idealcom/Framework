<?php

namespace Modules\Formulaire\Forms;

use Modules\Core\Forms\CoreForm;

class FormulairePreviewForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        $this->formOptions = [
            'class' => 'kt-form',
        ];

        $formulaire_fields = $this->getModel()->formulaire_fields;
        //dd($formulaire_fields);
        if (! empty($formulaire_fields)) {
            foreach ($formulaire_fields as $formulaire_field) {
                $this
                    ->add($formulaire_field->code, $formulaire_field->type, [
                        'label' => $formulaire_field->label_front,
                        'rules' => 'required',
                    ]);
            }
        }

        parent::buildForm();
    }
}
