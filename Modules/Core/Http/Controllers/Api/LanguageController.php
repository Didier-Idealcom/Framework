<?php

namespace Modules\Core\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Core\Entities\Language;
use Modules\Core\Transformers\LanguageResource;

/**
 * @OA\Tag(
 *     name="Languages",
 *     description="Languages API endpoints"
 * )
 */
class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     *
     * @OA\Get(
     *     path="/languages",
     *     operationId="getLanguagesList",
     *     tags={"Languages"},
     *     summary="Get all Languages",
     *     description="Returns list of all Languages",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/LanguageResource")
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
        return LanguageResource::collection(Language::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     *
     * @OA\Post(
     *     path="/languages",
     *     operationId="storeLanguage",
     *     tags={"Languages"},
     *     summary="Create new Language",
     *     description="Returns new Language data",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Language")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Language")
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
            'alpha2' => 'required|size:2|unique:languages',
            'alpha3' => 'required|size:3|unique:languages',
            'locale' => 'required',
            'name' => 'required'
        ]);

        $language = Language::create($request->all());
        return (new LanguageResource($language))->response()->setStatusCode(201);
    }

    /**
     * Show the specified resource.
     * @param  Language $language
     * @return Response
     *
     * @OA\Get(
     *     path="/languages/{id}",
     *     operationId="getLanguageById",
     *     tags={"Languages"},
     *     summary="Get Language details",
     *     description="Returns Language details",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Language id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Language")
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
    public function show(Language $language)
    {
        return new LanguageResource($language);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Language $language
     * @return Response
     *
     * @OA\Put(
     *     path="/languages/{id}",
     *     operationId="updateLanguage",
     *     tags={"Languages"},
     *     summary="Update existing Language",
     *     description="Returns updated Language data",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Language id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Language")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Language")
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
    public function update(Request $request, Language $language)
    {
        $language->update($request->all());
        return new LanguageResource($language);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Language $language
     * @return Response
     *
     * @OA\Delete(
     *     path="/languages/{id}",
     *     operationId="deleteLanguage",
     *     tags={"Languages"},
     *     summary="Delete existing Language",
     *     description="Deletes a Language record",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Language id",
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
    public function destroy(Language $language)
    {
        $language->delete();
        return response()->json(null, 204);
    }
}
