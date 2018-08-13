<?php

namespace Modules\Domain\Forms;

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
            'url' => $url
        ];

        $this
            ->add('title', 'text', [
                'label' => 'Titre',
                'rules' => 'required'
            ])
            ->add('name', 'text', [
                'label' => 'Nom',
                'rules' => 'required'
            ])
            ->add('extension', 'text', [
                'label' => 'Extension',
                'rules' => 'required'
            ])
            ->add('folder', 'text', [
                'label' => 'Dossier',
                'rules' => 'required'
            ])
            ->add('analytics', 'text', [
                'label' => 'Google Analytics',
                'rules' => 'required'
            ])
            ->add('search_console', 'text', [
                'label' => 'Search Console',
                'rules' => ''
            ])
            ->add('google_maps', 'text', [
                'label' => 'Google Maps',
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
            ->add('maintenance_message', 'text', [
                'label' => 'Message maintenance',
                'rules' => ''
            ]);
    }
}
