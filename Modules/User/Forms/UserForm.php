<?php

namespace Modules\User\Forms;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('users.update', $this->getModel()->id);
            $method = 'PUT';

            $this->getModel()->password = '';
        } else {
            $url = route('users.store');
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
            ])
            ->add('submit', 'submit', [
                'label' => 'Enregistrer'
            ]);
    }
}
