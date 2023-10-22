<?php

namespace Modules\Core\Forms;

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
            'url' => $url,
            'class' => 'kt-form'
        ];

        $this
            ->add('role', 'entity', [
                'label' => 'Rôle',
                'rules' => 'required',
                'multiple' => true,
                'class' => 'Modules\Core\Entities\Role'
            ])
            ->add('domain', 'entity', [
                'label' => 'Domaine',
                'rules' => 'required',
                'multiple' => true,
                'class' => 'Modules\Core\Entities\Domain'
            ])
            ->add('lang', 'entity', [
                'label' => 'Langue',
                'class' => 'Modules\Core\Entities\Language',
                'property' => 'name',
                'property_key' => 'alpha2',
                'query_builder' => function (\Modules\Core\Entities\Language $language) {
                    return $language->where('active', 'Y');
                }
            ])
            ->add('firstname', 'text', [
                'label' => 'Prénom',
                'rules' => 'required'
            ])
            ->add('lastname', 'text', [
                'label' => 'Nom',
                'rules' => 'required'
            ])
            ->add('email', 'email', [
                'label' => 'E-mail',
                'rules' => 'required|unique:users,email,' . $this->getModel()->id
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
            ->add('avatar', 'slim', [
                'label' => 'Avatar',
                'rules' => ''
            ]);

        parent::buildForm();
    }
}
