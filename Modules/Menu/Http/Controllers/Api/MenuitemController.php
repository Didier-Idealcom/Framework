<?php

namespace Modules\Menu\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menuitem;
use Modules\Menu\Transformers\MenuitemResource;

class MenuitemController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return MenuitemResource::collection(Menuitem::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Menuitem::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param  Menuitem $menuitem
     * @return Response
     */
    public function show(Menuitem $menuitem)
    {
        return new MenuitemResource($menuitem);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Menuitem $menuitem
     * @return Response
     */
    public function update(Request $request, Menuitem $menuitem)
    {
        $menuitem->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * @param  Menuitem $menuitem
     * @return Response
     */
    public function destroy(Menuitem $menuitem)
    {
        $menuitem->delete();
    }
}
