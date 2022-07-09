<?php

namespace Modules\Core\Components;

use Illuminate\View\Component;

class AddButton extends Component
{
    /**
     * The button url
     *
     * @var string
     */
    public $url;

    /**
     * Create the component instance
     *
     * @param  string  $url
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.addbutton');
    }
}
