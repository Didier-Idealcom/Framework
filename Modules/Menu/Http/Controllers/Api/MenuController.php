<?php

namespace Modules\Menu\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Transformers\MenuResource;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return MenuResource::collection(Menu::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Menu::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param  Menu $menu
     * @return Response
     */
    public function show(Menu $menu)
    {
        return new MenuResource($menu);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Menu $menu
     * @return Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * @param  Menu $menu
     * @return Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
    }
}
