<?php

namespace Modules\Formulaire\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Formulaire\Entities\Formulaire;
use Modules\Formulaire\Transformers\FormulaireResource;

/**
 * @OA\Tag(
 *     name="Formulaires",
 *     description="Formulaires API endpoints"
 * )
 */
class FormulaireController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     *
     * @OA\Get(
     *     path="/formulaires",
     *     operationId="getFormulairesList",
     *     tags={"Formulaires"},
     *     summary="Get all Formulaires",
     *     description="Returns list of all Formulaires",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/FormulaireResource")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return FormulaireResource::collection(Formulaire::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     *
     * @OA\Post(
     *     path="/formulaires",
     *     operationId="storeFormulaire",
     *     tags={"Formulaires"},
     *     summary="Create new Formulaire",
     *     description="Returns new Formulaire data",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Formulaire")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Formulaire")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Bad Request.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:formulaires'
        ]);

        $formulaire = Formulaire::create($request->all());
        return (new FormulaireResource($formulaire))->response()->setStatusCode(201);
    }

    /**
     * Show the specified resource.
     * @param  Formulaire $formulaire
     * @return Response
     *
     * @OA\Get(
     *     path="/formulaires/{id}",
     *     operationId="getFormulaireById",
     *     tags={"Formulaires"},
     *     summary="Get Formulaire details",
     *     description="Returns Formulaire details",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Formulaire id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Formulaire")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Bad Request.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Resource Not Found.")
     *         )
     *     )
     * )
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
     *
     * @OA\Put(
     *     path="/formulaires/{id}",
     *     operationId="updateFormulaire",
     *     tags={"Formulaires"},
     *     summary="Update existing Formulaire",
     *     description="Returns updated Formulaire data",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Formulaire id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Formulaire")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Formulaire")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Bad Request.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Resource Not Found.")
     *         )
     *     )
     * )
     */
    public function update(Request $request, Formulaire $formulaire)
    {
        $formulaire->update($request->all());
        return new FormulaireResource($formulaire);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Formulaire $formulaire
     * @return Response
     *
     * @OA\Delete(
     *     path="/formulaires/{id}",
     *     operationId="deleteFormulaire",
     *     tags={"Formulaires"},
     *     summary="Delete existing Formulaire",
     *     description="Deletes a Formulaire record",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Formulaire id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Resource Not Found.")
     *         )
     *     )
     * )
     */
    public function destroy(Formulaire $formulaire)
    {
        $formulaire->delete();
        return response()->json(null, 204);
    }
}
