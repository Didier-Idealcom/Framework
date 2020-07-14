<?php

namespace Modules\Formulaire\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Formulaire\Entities\Formulaire;
use Modules\Formulaire\Transformers\FormulaireResource;

class FormulaireController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return FormulaireResource::collection(Formulaire::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Formulaire::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param  Formulaire $formulaire
     * @return Response
     */
    public function show(Formulaire $formulaire)
    {
        return new FormulaireResource($formulaire);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Formulaire $formulaire
     * @return Response
     */
    public function update(Request $request, Formulaire $formulaire)
    {
        $formulaire->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * @param  Formulaire $formulaire
     * @return Response
     */
    public function destroy(Formulaire $formulaire)
    {
        $formulaire->delete();
    }
}
