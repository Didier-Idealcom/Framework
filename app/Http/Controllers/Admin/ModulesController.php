<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Module;

class ModulesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the modules list.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->modules = Module::all();

        //dd($this->modules);
        return view('admin.modules');
    }
}
