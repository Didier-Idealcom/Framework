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
            'url' => $url
        ];

        $this
            ->add('name', 'text', [
                'label' => 'Nom',
                'rules' => 'required'
            ])
            ->add('guard_name', 'text', [
                'label' => 'Nom du guard',
                'rules' => 'required'
            ]);
    }
}
