<?php

namespace Modules\Language\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Language\Entities\Language;
use Modules\Language\Transformers\LanguageResource;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return LanguageResource::collection(Language::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Language::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param  Language $language
     * @return Response
     */
    public function show(Language $language)
    {
        return new LanguageResource($language);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Language $language
     * @return Response
     */
    public function update(Request $request, Language $language)
    {
        $language->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * @param  Language $language
     * @return Response
     */
    public function destroy(Language $language)
    {
        $language->delete();
    }
}
