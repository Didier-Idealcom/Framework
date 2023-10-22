<?php

namespace Modules\Formulaire\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Formulaire\Entities\FormulaireField;
use Modules\Formulaire\Transformers\FormulaireFieldResource;

/**
 * @OA\Tag(
 *     name="FormulairesFields",
 *     description="FormulairesFields API endpoints"
 * )
 */
class FormulaireFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/formulaires_fields",
     *     operationId="getFormulairesFieldsList",
     *     tags={"FormulairesFields"},
     *     summary="Get all FormulairesFields",
     *     description="Returns list of all FormulairesFields",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/FormulaireFieldResource")
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return FormulaireFieldResource::collection(FormulaireField::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     *
     * @OA\Post(
     *     path="/formulaires_fields",
     *     operationId="storeFormulaireField",
     *     tags={"FormulairesFields"},
     *     summary="Create new FormulaireField",
     *     description="Returns new FormulaireField data",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/FormulaireField")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/FormulaireField")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Bad Request.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'formulaire_id' => 'required',
            'code' => 'required',
            'type' => 'required',
        ]);

        $formulaire_field = FormulaireField::create($request->all());

        return (new FormulaireFieldResource($formulaire_field))->response()->setStatusCode(201);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/formulaires_fields/{id}",
     *     operationId="getFormulaireFieldById",
     *     tags={"FormulairesFields"},
     *     summary="Get FormulaireField details",
     *     description="Returns FormulaireField details",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="FormulaireField id",
     *         required=true,
     *         in="path",
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/FormulaireField")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Bad Request.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Resource Not Found.")
     *         )
     *     )
     * )
     */
    public function show(FormulaireField $formulaire_field)
    {
        return new FormulaireFieldResource($formulaire_field);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     *
     * @OA\Put(
     *     path="/formulaires_fields/{id}",
     *     operationId="updateFormulaireField",
     *     tags={"FormulairesFields"},
     *     summary="Update existing FormulaireField",
     *     description="Returns updated FormulaireField data",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="FormulaireField id",
     *         required=true,
     *         in="path",
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/FormulaireField")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/FormulaireField")
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Bad Request.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Resource Not Found.")
     *         )
     *     )
     * )
     */
    public function update(Request $request, FormulaireField $formulaire_field)
    {
        $formulaire_field->update($request->all());

        return new FormulaireFieldResource($formulaire_field);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     *
     * @OA\Delete(
     *     path="/formulaires_fields/{id}",
     *     operationId="deleteFormulaireField",
     *     tags={"FormulairesFields"},
     *     summary="Delete existing FormulaireField",
     *     description="Deletes a FormulaireField record",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="FormulaireField id",
     *         required=true,
     *         in="path",
     *
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=204,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Forbidden.")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Resource Not Found.")
     *         )
     *     )
     * )
     */
    public function destroy(FormulaireField $formulaire_field)
    {
        $formulaire_field->delete();

        return response()->json(null, 204);
    }
}
