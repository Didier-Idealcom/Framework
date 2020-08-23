<?php

namespace Modules\Dashboard\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('dashboard::admin.index');
    }

    public function media()
    {
        //dump(Storage::disk());
        //dump(Storage::disk('s3'));
        //dump(Storage::disk('cloudinary'));

        //dump(Storage::allFiles());
        //dump(Storage::disk('s3')->allFiles());
        //dump(Storage::disk('cloudinary')->allFiles());
        //die;

        return view('dashboard::admin.media');
    }

    public function upload(Request $request)
    {
        dump($request->file('avatar'));
        $path = $request->file('avatar')->storeAs('public', $request->file('avatar')->getClientOriginalName());
        dump($path);
        dump(Storage::url($path));
    }
}
