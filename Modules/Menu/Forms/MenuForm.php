<?php

namespace Modules\Menu\Forms;

use Modules\Core\Forms\CoreForm;

class MenuForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.menus.update', $this->getModel()->id);
            $method = 'PUT';
        } else {
            $url = route('admin.menus.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form'
        ];

        $this
            ->add('code', 'text', [
                'label' => 'Code',
                'rules' => 'required'
            ])
            ->add('title', 'text', [
                'label' => 'Titre',
                'rules' => 'required',
                'translatable' => true
            ])
            ->add('menuitems_data', 'hidden');

        parent::buildForm();
    }
}
