<?php

namespace Modules\Core\Forms;

use Illuminate\Validation\Rule;

class DomainLanguageForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.domains_languages.update', $this->getModel()->id);
            $method = 'PUT';
            $domain_id = $this->getModel()->domain_id;
        } else {
            $url = route('admin.domains_languages.store');
            $method = 'POST';
            if ($this->getRequest()->get('domain_id')) {
                $domain_id = $this->getRequest()->get('domain_id');
            } else {
                $domain = $this->getRequest()->route()->parameter('domain');
                $domain_id = $domain->id;
            }
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form',
        ];

        $this
            ->add('domain_id', 'hidden', [
                'rules' => 'required',
                'default_value' => $domain_id,
            ])
            ->add('language_id', 'entity', [
                'label' => 'Langue',
                'rules' => [
                    'required',
                    Rule::unique('domains_languages')->where(function ($query) use ($domain_id) {
                        return $query->where('domain_id', $domain_id);
                    })->ignore($this->getModel()->id),
                ],
                'class' => 'Modules\Core\Entities\Language',
                'property_key' => 'id',
                'property' => 'name',
            ])
            ->add('url_redirect', 'text', [
                'label' => 'URL redirection',
                'rules' => '',
            ])
            ->add('url_blog', 'text', [
                'label' => 'URL blog',
                'rules' => '',
            ])
            ->add('url_facebook', 'text', [
                'label' => 'URL Facebook',
                'rules' => '',
            ])
            ->add('url_instagram', 'text', [
                'label' => 'URL Instagram',
                'rules' => '',
            ])
            ->add('url_linkedin', 'text', [
                'label' => 'URL Linkedin',
                'rules' => '',
            ])
            ->add('url_pinterest', 'text', [
                'label' => 'URL Pinterest',
                'rules' => '',
            ])
            ->add('url_twitter', 'text', [
                'label' => 'URL Twitter',
                'rules' => '',
            ])
            ->add('url_youtube', 'text', [
                'label' => 'URL Youtube',
                'rules' => '',
            ]);

        parent::buildForm();
    }
}
