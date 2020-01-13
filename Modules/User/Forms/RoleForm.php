<?php

namespace Modules\User\Forms;

use Modules\Core\Forms\CoreForm;

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
            'class' => 'kt-form'
        ];

        $this
            ->add('name', 'text', [
                'label' => 'Nom',
                'rules' => 'required'
            ])
            ->add('guard_name', 'text', [
                'label' => 'Nom du guard',
                'rules' => 'required'
            ])
            ->add('permission', 'entity', [
                'label' => 'Permissions',
                'label_show' => false,
                'rules' => '',
                'multiple' => true,
                'class' => 'Modules\User\Entities\Permission'
            ]);

        parent::buildForm();
    }
}
