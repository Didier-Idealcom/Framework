<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\User\Entities\Role;
use Modules\User\Forms\RoleForm;
use Modules\Core\Repositories\CoreRepository;

class RoleController extends Controller
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
     * RoleController constructor.
     * @param Role $role
     * @param FormBuilder $formBuilder
     */
    public function __construct(Role $role, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new CoreRepository($role);
    }

    /**
     * Return the formBuilder
     * @param Role|null $role
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?Role $role = null)
    {
        $role = $role ?: new Role();
        return $this->formBuilder->create(RoleForm::class, [
            'model' => $role
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $roles = $this->repository->load(10);
        return view('user::admin.role_index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('user::admin.role_form', compact('form'));
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
        $role = $this->repository->create($request->all());
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the specified resource.
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $role = $this->repository->find($id);
        return view('user::admin.role_show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        $form = $this->getForm($role);
        return view('user::admin.role_form', compact('form'));
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
        $role = $this->repository->update($id, $request->all());
        Session::flash('success', 'Le rôle a été enregistré avec succès');
        return redirect()->route('admin.roles.index');
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
        return Datatables::of(Role::all())
            ->addColumn('actions', function($role) {
                return '
                    <a href="' . $role->url_backend->edit . '" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $role->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
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
