<?php

namespace Modules\User\Forms;

use Modules\Core\Forms\CoreForm;

class PermissionForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.permissions.update', $this->getModel()->id);
            $method = 'PUT';

            $this->getModel()->password = '';
        } else {
            $url = route('admin.permissions.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form'
        ];

        // Guard options
        $auth_guards = array_keys(config('auth.guards'));
        $guards_choices = array_combine($auth_guards, $auth_guards);

        $this
            ->add('name', 'text', [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Module:Permission'
                ],
                'rules' => 'required|regex:/^(.*):(.*)$/'
            ])
            ->add('guard_name', 'select', [
                'label' => 'Nom du guard',
                'choices' => $guards_choices,
                'empty_value' => 'Sélectionnez...',
                'rules' => 'required'
            ]);

        parent::buildForm();
    }
}
