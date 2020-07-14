<?php

namespace Modules\Domain\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Domain\Entities\Domain;
use Modules\Domain\Transformers\DomainResource;

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
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
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
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     )
     * )
     */
    public function store(Request $request)
    {
        Domain::create($request->all());
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
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found"
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
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found"
     *     )
     * )
     */
    public function update(Request $request, Domain $domain)
    {
        $domain->update($request->all());
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
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Resource Not Found"
     *     )
     * )
     */
    public function destroy(Domain $domain)
    {
        $domain->delete();
    }
}
