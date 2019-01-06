<?php

namespace Modules\User\Forms;

use Modules\Core\Forms\CoreForm;

class UserForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.users.update', $this->getModel()->id);
            $method = 'PUT';

            unset($this->getModel()->password);
        } else {
            $url = route('admin.users.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url
        ];

        $this
            ->add('role', 'entity', [
                'label' => 'Rôle',
                'rules' => 'required',
                'multiple' => true,
                'class' => 'Modules\User\Entities\Role'
            ])
            ->add('name', 'text', [
                'label' => 'Nom',
                'rules' => 'required'
            ])
            ->add('email', 'email', [
                'label' => 'E-mail',
                'rules' => !$this->getModel() ? 'required|unique:users' : 'required'
            ])
            ->add('password', 'repeated', [
                'first_options' => [
                    'label' => 'Mot de passe',
                    'rules' => !$this->getModel() ? 'required' : ''
                ],
                'second_options' => [
                    'label' => 'Confirmation mot de passe',
                    'rules' => !$this->getModel() ? 'required|same:password' : 'same:password'
                ]
            ]);
    }
}
