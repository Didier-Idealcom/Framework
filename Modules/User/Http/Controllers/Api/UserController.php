<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\User;
use Modules\User\Transformers\UserResource;

class UserController extends Controller
{
    /**
     * @OA\Info(
     *     version="1.0.0",
     *     title="Framework API Documentation",
     *     description="",
     *     @OA\Contact(
     *         url="https://www.ideal-com.com",
     *         email="d.largeron@ideal-com.com"
     *     )
     * )
     *
     * @OA\Server(
     *     url=L5_SWAGGER_CONST_HOST,
     *     description="Demo API Server"
     * )
     *
     * @OA\Tag(
     *     name="Users",
     *     description="Users API endpoints"
     * )
     */

    /**
     * Display a listing of the resource.
     * @return Response
     *
     * @OA\Get(
     *     path="/users",
     *     operationId="getUsersList",
     *     tags={"Users"},
     *     summary="Get all Users",
     *     description="Returns list of all Users",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
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
        return UserResource::collection(User::paginate());
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     *
     * @OA\Post(
     *     path="/users",
     *     operationId="storeUser",
     *     tags={"Users"},
     *     summary="Create new User",
     *     description="Returns new User data",
     *     security={
     *         {"passport": {}},
     *     },
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
        User::create($request->all());
    }

    /**
     * Show the specified resource.
     * @param  User $user
     * @return Response
     *
     * @OA\Get(
     *     path="/users/{id}",
     *     operationId="getUserById",
     *     tags={"Users"},
     *     summary="Get User details",
     *     description="Returns User details",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="User id",
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
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  User $user
     * @return Response
     *
     * @OA\Put(
     *     path="/users/{id}",
     *     operationId="updateUser",
     *     tags={"Users"},
     *     summary="Update existing User",
     *     description="Returns updated User data",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="User id",
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
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     * @param  User $user
     * @return Response
     *
     * @OA\Delete(
     *     path="/users/{id}",
     *     operationId="deleteUser",
     *     tags={"Users"},
     *     summary="Delete existing User",
     *     description="Deletes a User record",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Parameter(
     *         name="id",
     *         description="User id",
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
    public function destroy(User $user)
    {
        $user->delete();
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
     *     @OA\Parameter(
     *         name="email",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);


        if (!auth()->attempt($validator)) {
            return response()->json(['error' => 'Unauthorised'], 401);
        } else {
            $success['token'] = auth()->user()->createToken('authToken')->accessToken;
            $success['user'] = auth()->user();
            return response()->json(['success' => $success])->setStatusCode(Response::HTTP_ACCEPTED);
        }
    }
}
