<?php

namespace Modules\Core\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * The alert type
     *
     * @var string
     */
    public $type;

    /**
     * The alert message
     *
     * @var string
     */
    public $message;

    /**
     * The alert icon
     *
     * @var string
     */
    public $icon;

    /**
     * Is alert dismissible
     *
     * @var bool
     */
    public $dismiss;

    /**
     * Create the component instance
     *
     * @param  string  $type
     * @param  string  $message
     * @param  string  $icon
     * @param  bool    $dismiss
     * @return void
     */
    public function __construct($type, $message, $icon, $dismiss)
    {
        $this->type = $type;
        $this->message = $message;
        $this->icon = $icon;
        $this->dismiss = $dismiss;
    }

    /**
     * Get the view / contents that represent the component
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
