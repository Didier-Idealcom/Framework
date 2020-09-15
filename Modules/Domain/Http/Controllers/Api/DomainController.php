<?php

namespace Modules\Domain\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\Domain;
use Modules\Domain\Transformers\DomainResource;

/**
 * @OA\Tag(
 *     name="Domains",
 *     description="Domains API endpoints"
 * )
 */
class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     *
     * @OA\Get(
     *     path="/domains",
     *     operationId="getDomainsList",
     *     tags={"Domains"},
     *     summary="Get all Domains",
     *     description="Returns list of all Domains",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/DomainResource")
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
        return DomainResource::collection(Domain::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     *
     * @OA\Post(
     *     path="/domains",
     *     operationId="storeDomain",
     *     tags={"Domains"},
     *     summary="Create new Domain",
     *     description="Returns new Domain data",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Domain")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Domain")
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
            'title' => 'required',
            'name' => 'required'
        ]);

        $domain = Domain::create($request->all());
        return (new DomainResource($domain))->response()->setStatusCode(201);
    }

    /**
     * Show the specified resource.
     * @param  Domain $domain
     * @return Response
     *
     * @OA\Get(
     *     path="/domains/{id}",
     *     operationId="getDomainById",
     *     tags={"Domains"},
     *     summary="Get Domain details",
     *     description="Returns Domain details",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Domain id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Domain")
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
    public function show(Domain $domain)
    {
        return new DomainResource($domain);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Domain $domain
     * @return Response
     *
     * @OA\Put(
     *     path="/domains/{id}",
     *     operationId="updateDomain",
     *     tags={"Domains"},
     *     summary="Update existing Domain",
     *     description="Returns updated Domain data",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Domain id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Domain")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Domain")
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
    public function update(Request $request, Domain $domain)
    {
        $domain->update($request->all());
        return new DomainResource($domain);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Domain $domain
     * @return Response
     *
     * @OA\Delete(
     *     path="/domains/{id}",
     *     operationId="deleteDomain",
     *     tags={"Domains"},
     *     summary="Delete existing Domain",
     *     description="Deletes a Domain record",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Domain id",
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
    public function destroy(Domain $domain)
    {
        $domain->delete();
        return response()->json(null, 204);
    }
}
