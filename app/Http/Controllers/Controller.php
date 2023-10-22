<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *     version="1.0.0",
     *     title="Framework API Documentation",
     *     description="",
     *
     *     @OA\Contact(
     *         name="Ideal-com",
     *         url="https://www.ideal-com.com",
     *         email="largeron.didier@gmail.com"
     *     )
     * )
     *
     * @OA\Server(
     *     url=L5_SWAGGER_CONST_HOST,
     *     description="Demo API Server"
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __set($name, $value)
    {
        View::share($name, $value);
    }
}
