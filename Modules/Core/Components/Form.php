<?php

namespace Modules\Core\Components;

use Illuminate\View\Component;

class Form extends Component
{
    /**
     * The form object
     *
     * @var object
     */
    public $form;

    /**
     * Submit button ?
     *
     * @var bool
     */
    public $submit;

    /**
     * Create the component instance
     *
     * @param  object  $form
     * @param  bool  $submit
     * @return void
     */
    public function __construct($form, $submit = false)
    {
        $this->form = $form;
        $this->submit = $submit;
    }

    /**
     * Get the view / contents that represent the component
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
