<?php

namespace Modules\Email\Forms;

use \Module;
use Modules\Core\Forms\CoreForm;

class EmailForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.emails.update', $this->getModel()->id);
            $method = 'PUT';
        } else {
            $url = route('admin.emails.store');
            $method = 'POST';
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url
        ];

        $modules = Module::all();
        $modules_array = array();
        foreach ($modules as $module) {
            $modules_array[$module->getName()] = $module->getName();
        }

        $this
            ->add('module', 'select', [
                'label' => 'Module',
                'rules' => 'required',
                'choices' => $modules_array
            ])
            ->add('name', 'text', [
                'label' => 'Nom',
                'rules' => 'required'
            ])
            ->add('description', 'textarea', [
                'label' => 'Description',
                'rules' => ''
            ])
            ->add('from', 'email', [
                'label' => 'From',
                'rules' => ''
            ])
            ->add('reply_to', 'email', [
                'label' => 'Reply to',
                'rules' => ''
            ])
            ->add('to', 'text', [
                'label' => 'To',
                'rules' => ''
            ])
            ->add('cc', 'text', [
                'label' => 'CC',
                'rules' => ''
            ])
            ->add('bcc', 'text', [
                'label' => 'BCC',
                'rules' => ''
            ])
            ->add('delay', 'text', [
                'label' => 'Délai',
                'rules' => ''
            ]);

        parent::buildForm();
    }
}
