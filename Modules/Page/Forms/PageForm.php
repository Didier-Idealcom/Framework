<?php

namespace Modules\Page\Forms;

use Modules\Core\Forms\CoreForm;

class PageForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.pages.update', $this->getModel()->id);
            $method = 'PUT';
        } else {
            $url = route('admin.pages.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url
        ];

        $this
            ->add('title', 'text', [
                'label' => 'Titre',
                'rules' => 'required',
                'translatable' => true
            ])
            ->add('content', 'textarea', [
                'label' => 'Contenu',
                'rules' => 'required',
                'translatable' => true
            ]);

        parent::buildForm();
    }
}
