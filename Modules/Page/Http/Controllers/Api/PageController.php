<?php

namespace Modules\Page\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Page\Entities\Page;
use Modules\Page\Transformers\PageResource;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return PageResource::collection(Page::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Page::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param  Page $page
     * @return Response
     */
    public function show(Page $page)
    {
        return new PageResource($page);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Page $page
     * @return Response
     */
    public function update(Request $request, Page $page)
    {
        $page->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * @param  Page $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
    }
}
