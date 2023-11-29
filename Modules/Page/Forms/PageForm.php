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
            //$url_show = route('admin.pages.show', $this->getModel()->id);
            //$url_preview = route('admin.pages_preview', $this->getModel()->id);
            $method = 'PUT';
        } else {
            $url = route('admin.pages.store');
            //$url_show = '';
            //$url_preview = '';
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form',
        ];

        $this
            ->add('title', 'text', [
                'label' => 'Titre',
                'rules' => 'required',
                'translatable' => true,
            ])
            ->add('content', 'grapesjs', [
                'label' => 'Contenu',
                'rules' => 'required',
                'translatable' => true,
            ]);
        /*->add('content', 'visualeditor', [
            'label' => 'Contenu',
            'rules' => 'required',
            'translatable' => true,
            'url_show' => $url_show,
            'url_preview' => $url_preview
        ]);*/

        parent::buildForm();
    }
}
