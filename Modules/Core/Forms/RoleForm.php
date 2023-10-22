<?php

namespace Modules\Core\Forms;

class RoleForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.roles.update', $this->getModel()->id);
            $method = 'PUT';

            $this->getModel()->password = '';
        } else {
            $url = route('admin.roles.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form',
        ];

        // Guard options
        $auth_guards = array_keys(config('auth.guards'));
        $guards_choices = array_combine($auth_guards, $auth_guards);

        $this
            ->add('name', 'text', [
                'label' => 'Nom',
                'rules' => 'required',
            ])
            ->add('guard_name', 'select', [
                'label' => 'Nom du guard',
                'choices' => $guards_choices,
                'empty_value' => 'Sélectionnez...',
                'rules' => 'required',
            ])
            ->add('permission', 'permission', [
                'label' => 'Permissions',
                'rules' => '',
                'expanded' => true,
                'multiple' => true,
                'class' => 'Modules\Core\Entities\Permission',
            ]);

        parent::buildForm();
    }
}
