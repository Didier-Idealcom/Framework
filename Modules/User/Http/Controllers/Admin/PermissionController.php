<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\User\Entities\Permission;
use Modules\User\Forms\PermissionForm;
use Modules\Core\Repositories\CoreRepository;

class PermissionController extends Controller
{
    /**
     * @var FormBuilder
     */
    private $formBuilder;

    /**
     * @var CoreRepository
     */
    protected $repository;

    /**
     * PermissionController constructor.
     * @param Permission $permission
     * @param FormBuilder $formBuilder
     */
    public function __construct(Permission $permission, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new CoreRepository($permission);
    }

    /**
     * Return the formBuilder
     * @param Permission|null $permission
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?Permission $permission = null)
    {
        $permission = $permission ?: new Permission();
        return $this->formBuilder->create(PermissionForm::class, [
            'model' => $permission
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $permissions = $this->repository->load(10);
        return view('user::admin.permission_index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('user::admin.permission_form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $form = $this->getForm();
        $form->redirectIfNotValid();
        $permission = $this->repository->create($request->all());
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Show the specified resource.
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $permission = $this->repository->find($id);
        return view('user::admin.permission_show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Permission $permission
     * @return Response
     */
    public function edit(Permission $permission)
    {
        $form = $this->getForm($permission);
        return view('user::admin.permission_form', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $form = $this->getForm();
        $form->redirectIfNotValid();
        $permission = $this->repository->update($id, $request->all());
        Session::flash('success', 'La permission a été enregistrée avec succès');
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        return Datatables::of(Permission::all())
            ->addColumn('actions', function($permission) {
                return '
                    <a href="' . $permission->url_backend->edit . '" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $permission->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                    </form>
                ';
            })
            ->escapeColumns(['name', 'guard_name'])
            ->make(true);
    }
}
