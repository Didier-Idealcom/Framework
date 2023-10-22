<?php

namespace Modules\Core\Forms;

use Modules\Core\Forms\CoreForm;

class DomainForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.domains.update', $this->getModel()->id);
            $method = 'PUT';
        } else {
            $url = route('admin.domains.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form'
        ];

        $this
            ->add('title', 'text', [
                'label' => 'Titre',
                'rules' => 'required'
            ])
            ->add('name', 'text', [
                'label' => 'Nom de domaine',
                'rules' => 'required'
            ])
            ->add('folder', 'text', [
                'label' => 'Dossier',
                'rules' => ''
            ])
            ->add('analytics', 'text', [
                'label' => 'Google Analytics',
                'rules' => ''
            ])
            ->add('google_maps_api_key', 'text', [
                'label' => 'Google Maps API key',
                'rules' => ''
            ])
            ->add('maintenance_start', 'date', [
                'label' => 'Début maintenance',
                'rules' => ''
            ])
            ->add('maintenance_end', 'date', [
                'label' => 'Fin maintenance',
                'rules' => ''
            ])
            ->add('maintenance_message', 'textarea', [
                'label' => 'Message maintenance',
                'rules' => ''
            ]);

        parent::buildForm();
    }
}
