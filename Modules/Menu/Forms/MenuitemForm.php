<?php

namespace Modules\Menu\Forms;

use Modules\Core\Forms\CoreForm;

class MenuitemForm extends CoreForm
{
    public function buildForm()
    {
        // Form options
        if ($this->getModel() && $this->getModel()->id) {
            $url = route('admin.menuitems.update', $this->getModel()->id);
            $method = 'PUT';
            $menu_id = $this->getModel()->menu_id;
            $parent_id = $this->getModel()->parent_id;
        } else {
            $url = route('admin.menuitems.store');
            $method = 'POST';
            if ($this->getRequest()->get('menu_id')) {
                $menu_id = $this->getRequest()->get('menu_id');
            } else {
                $menu = $this->getRequest()->route()->parameter('menu');
                $menu_id = $menu->id;
            }
            if ($this->getRequest()->get('parent_id')) {
                $parent_id = $this->getRequest()->get('parent_id');
            } else {
                $parent_id = $this->getRequest()->route()->parameter('parent');
            }
        }
        $this->formOptions = [
            'method' => $method,
            'url' => $url,
            'class' => 'kt-form',
        ];

        $this
            /*->add('menu_id', 'entity', [
                'label' => 'Menu',
                'rules' => 'required',
                'class' => 'Modules\Menu\Entities\MenuTranslation',
                'property_key' => 'menu_id',
                'property' => 'title'
            ])*/
            ->add('menu_id', 'hidden', [
                'rules' => 'required',
                'default_value' => $menu_id,
            ])
            ->add('parent_id', 'hidden', [
                'rules' => '',
                'default_value' => $parent_id,
            ])
            ->add('title_menu', 'text', [
                'label' => 'Titre menu',
                'rules' => 'required',
                'translatable' => true,
            ])
            ->add('title_page', 'text', [
                'label' => 'Titre page',
                'rules' => 'required',
                'translatable' => true,
            ])
            ->add('gabarit', 'select', [
                'label' => 'Gabarit',
                'rules' => '',
                'choices' => ['index_index' => 'Accueil', 'actualites_index' => 'Listing actualités', 'cmspages_index' => 'Page de contenu'],
                'empty_value' => 'Sélectionnez...',
            ])
            ->add('link', 'url', [
                'label' => 'Lien',
                'rules' => '',
                'translatable' => true,
            ])
            ->add('target', 'select', [
                'label' => 'Cible',
                'rules' => '',
                'choices' => ['_self' => 'Même fenêtre', '_blank' => 'Nouvelle fenêtre'],
                'selected' => '_self',
                'translatable' => true,
            ])
            ->add('visible', 'select', [
                'label' => 'Visible',
                'rules' => '',
                'choices' => ['Y' => 'Oui', 'N' => 'Non'],
                'selected' => 'Y',
            ])
            ->add('cliquable', 'select', [
                'label' => 'Cliquable',
                'rules' => '',
                'choices' => ['Y' => 'Oui', 'N' => 'Non'],
                'selected' => 'Y',
            ])
            ->add('format', 'select', [
                'label' => 'Format',
                'rules' => '',
                'choices' => ['submenu' => 'Petit', 'big_submenu' => 'Grand'],
                'selected' => 'submenu',
            ]);

        parent::buildForm();
    }
}
