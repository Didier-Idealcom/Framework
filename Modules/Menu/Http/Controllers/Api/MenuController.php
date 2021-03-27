<?php

namespace Modules\Menu\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\Menuitem;
use Modules\Menu\Transformers\MenuResource;
use Modules\Menu\Transformers\MenuitemResource;

/**
 * @OA\Tag(
 *     name="Menus",
 *     description="Menus API endpoints"
 * )
 */
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     *
     * @OA\Get(
     *     path="/menus",
     *     operationId="getMenusList",
     *     tags={"Menus"},
     *     summary="Get all Menus",
     *     description="Returns list of all Menus",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/MenuResource")
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
        return MenuResource::collection(Menu::paginate());
    }

    /**
     * Display a listing of the resource.
     * @return Response
     *
     * @OA\Get(
     *     path="/menus/{id}/menuitems",
     *     operationId="getMenuMenuitemsList",
     *     tags={"Menus"},
     *     summary="Get all Menuitems of a Menu",
     *     description="Returns list of all Menuitems of a Menu",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/MenuitemResource")
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
    public function menuitems(Menu $menu)
    {
        return MenuitemResource::collection(Menuitem::where('menu_id', '=', $menu->id)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     *
     * @OA\Post(
     *     path="/menus",
     *     operationId="storeMenu",
     *     tags={"Menus"},
     *     summary="Create new Menu",
     *     description="Returns new Menu data",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Menu")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Menu")
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
            'code' => 'required|unique:menus'
        ]);

        $menu = Menu::create($request->all());
        return (new MenuResource($menu))->response()->setStatusCode(201);
    }

    /**
     * Show the specified resource.
     * @param  Menu $menu
     * @return Response
     *
     * @OA\Get(
     *     path="/menus/{id}",
     *     operationId="getMenuById",
     *     tags={"Menus"},
     *     summary="Get Menu details",
     *     description="Returns Menu details",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Menu id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Menu")
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
    public function show(Menu $menu)
    {
        return new MenuResource($menu);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Menu $menu
     * @return Response
     *
     * @OA\Put(
     *     path="/menus/{id}",
     *     operationId="updateMenu",
     *     tags={"Menus"},
     *     summary="Update existing Menu",
     *     description="Returns updated Menu data",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Menu id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Menu")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Menu")
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
    public function update(Request $request, Menu $menu)
    {
        $menu->update($request->all());
        return new MenuResource($menu);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Menu $menu
     * @return Response
     *
     * @OA\Delete(
     *     path="/menus/{id}",
     *     operationId="deleteMenu",
     *     tags={"Menus"},
     *     summary="Delete existing Menu",
     *     description="Deletes a Menu record",
     *     security={
     *         {"passport": {}}
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="Menu id",
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
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json(null, 204);
    }
}
