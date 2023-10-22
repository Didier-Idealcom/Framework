<?php

namespace Modules\Menu\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menuitem;
use Modules\Menu\Transformers\MenuitemResource;

/**
 * @OA\Tag(
 *     name="Menuitems",
 *     description="Menuitems API endpoints"
 * )
 */
class MenuitemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/menuitems",
     *     operationId="getMenuitemsList",
     *     tags={"Menuitems"},
     *     summary="Get all Menuitems",
     *     description="Returns list of all Menuitems",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/MenuitemResource")
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
        return MenuitemResource::collection(Menuitem::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     *
     * @OA\Post(
     *     path="/menuitems",
     *     operationId="storeMenuitem",
     *     tags={"Menuitems"},
     *     summary="Create new Menuitem",
     *     description="Returns new Menuitem data",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/Menuitem")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Menuitem")
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

        $menuitem = Menuitem::create($request->all());

        return (new MenuitemResource($menuitem))->response()->setStatusCode(201);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/menuitems/{id}",
     *     operationId="getMenuitemById",
     *     tags={"Menuitems"},
     *     summary="Get Menuitem details",
     *     description="Returns Menuitem details",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="Menuitem id",
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
     *         @OA\JsonContent(ref="#/components/schemas/Menuitem")
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
    public function show(Menuitem $menuitem)
    {
        return new MenuitemResource($menuitem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     *
     * @OA\Put(
     *     path="/menuitems/{id}",
     *     operationId="updateMenuitem",
     *     tags={"Menuitems"},
     *     summary="Update existing Menuitem",
     *     description="Returns updated Menuitem data",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="Menuitem id",
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
     *         @OA\JsonContent(ref="#/components/schemas/Menuitem")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/Menuitem")
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
    public function update(Request $request, Menuitem $menuitem)
    {
        $menuitem->update($request->all());

        return new MenuitemResource($menuitem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     *
     * @OA\Delete(
     *     path="/menuitems/{id}",
     *     operationId="deleteMenuitem",
     *     tags={"Menuitems"},
     *     summary="Delete existing Menuitem",
     *     description="Deletes a Menuitem record",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="Menuitem id",
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
    public function destroy(Menuitem $menuitem)
    {
        $menuitem->delete();

        return response()->json(null, 204);
    }
}
