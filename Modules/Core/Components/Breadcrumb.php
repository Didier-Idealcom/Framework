<?php

namespace Modules\Core\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * The breadcrumb items
     *
     * @var array
     */
    public $items;

    /**
     * Create the component instance
     *
     * @param  array  $items
     * @return void
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Get the view / contents that represent the component
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
