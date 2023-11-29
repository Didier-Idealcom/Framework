<?php

namespace Modules\Core\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Core\Entities\User;
use Modules\Core\Transformers\UserResource;

/**
 * @OA\Tag(
 *     name="Users",
 *     description="Users API endpoints"
 * )
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/users",
     *     operationId="getUsersList",
     *     tags={"Users"},
     *     summary="Get all Users",
     *     description="Returns list of all Users",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
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
        return UserResource::collection(User::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     *
     * @OA\Post(
     *     path="/users",
     *     operationId="storeUser",
     *     tags={"Users"},
     *     summary="Create new User",
     *     description="Returns new User data",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/User")
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
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = User::create($request->all());

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     *
     * @OA\Get(
     *     path="/users/{id}",
     *     operationId="getUserById",
     *     tags={"Users"},
     *     summary="Get User details",
     *     description="Returns User details",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="User id",
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
     *         @OA\JsonContent(ref="#/components/schemas/User")
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
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     *
     * @OA\Put(
     *     path="/users/{id}",
     *     operationId="updateUser",
     *     tags={"Users"},
     *     summary="Update existing User",
     *     description="Returns updated User data",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="User id",
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
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/User")
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
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     *
     * @OA\Delete(
     *     path="/users/{id}",
     *     operationId="deleteUser",
     *     tags={"Users"},
     *     summary="Delete existing User",
     *     description="Deletes a User record",
     *     security={
     *         {"passport": {}}
     *     },
     *
     *     @OA\Parameter(
     *         name="id",
     *         description="User id",
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
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }

    /**
     * Login API
     *
     * @return \Illuminate\Http\Response
     *
     * @OA\Post(
     *     path="/login",
     *     operationId="Login",
     *     summary="API Login",
     *     description="Returns authentification token",
     *
     *     @OA\Parameter(
     *         name="email",
     *         required=true,
     *         in="query",
     *
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Parameter(
     *         name="password",
     *         required=true,
     *         in="query",
     *
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=202,
     *         description="Successful operation"
     *     ),
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
     *     )
     * )
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Bad Request.', 'errors' => $validator->errors()], 400);
        }

        if (! auth()->attempt(['email' => request('email'), 'password' => request('password')])) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $success = [];
        $success['token'] = auth()->user()->createToken('authToken')->accessToken;
        $success['user'] = auth()->user();

        return response()->json(['success' => $success])->setStatusCode(202);
    }
}
