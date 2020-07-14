<?php

namespace Modules\Formulaire\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Formulaire\Entities\FormulaireField;
use Modules\Formulaire\Transformers\FormulaireFieldResource;

class FormulaireFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return FormulaireFieldResource::collection(FormulaireField::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        FormulaireField::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param  FormulaireField $user
     * @return Response
     */
    public function show(FormulaireField $user)
    {
        return new FormulaireFieldResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  FormulaireField $user
     * @return Response
     */
    public function update(Request $request, FormulaireField $user)
    {
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * @param  FormulaireField $user
     * @return Response
     */
    public function destroy(FormulaireField $user)
    {
        $user->delete();
    }
}
