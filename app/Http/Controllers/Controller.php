<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *     version="1.0.0",
     *     title="Framework API Documentation",
     *     description="",
     *     @OA\Contact(
     *         name="Ideal-com",
     *         url="https://www.ideal-com.com",
     *         email="d.largeron@ideal-com.com"
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
