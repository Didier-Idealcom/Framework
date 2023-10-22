<?php

namespace Modules\Core\Components;

use Illuminate\View\Component;

class Datatable extends Component
{
    /**
     * The datatable id
     *
     * @var string
     */
    public $id;

    /**
     * Enable/Disable datatable search
     *
     * @var bool
     */
    public $search;

    /**
     * Enable/Disable datatable filter
     *
     * @var bool
     */
    public $filter;

    /**
     * The datatable import URL
     *
     * @var string
     */
    public $import;

    /**
     * The datatable export URL
     *
     * @var string
     */
    public $export;

    /**
     * Create the component instance
     *
     * @param  string  $id
     * @param  bool  $search
     * @param  bool  $filter
     * @param  string  $import
     * @param  string  $export
     * @return void
     */
    public function __construct($id, $search, $filter, $import, $export)
    {
        $this->id = $id;
        $this->search = $search;
        $this->filter = $filter;
        $this->import = $import;
        $this->export = $export;
    }

    /**
     * Get the view / contents that represent the component
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datatable');
    }
}
