<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\User\Entities\Role;
use Modules\User\Entities\Permission;
use Modules\User\Forms\RoleForm;
use Modules\Core\Repositories\ModelRepository;

class RoleController extends Controller
{
    /**
     * @var FormBuilder
     */
    private $formBuilder;

    /**
     * @var ModelRepository
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
        $this->repository = new ModelRepository($role);
    }

    /**
     * Return the formBuilder
     * @param  Role|null $role
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
        return view('user::admin.role_index');
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

        Session::flash('success', 'Le rôle a été créé avec succès');
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the specified resource.
     * @param  Role $role
     * @return Response
     */
    public function show(Role $role)
    {
        return view('user::admin.role_show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        $form = $this->getForm($role);
        $form->getField('permission')->setValue($role->permissions->pluck('id')->values());
        return view('user::admin.role_form', compact('form', 'role'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Role $role
     * @return Response
     */
    public function update(Request $request, Role $role)
    {
        $form = $this->getForm($role);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($role->id, $request->all());

        $role->syncPermissions($request->has('permission') ? Permission::whereIn('id', $request->get('permission'))->get() : []);

        Session::flash('success', 'Le rôle a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.roles.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.roles.index');
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param Role $role
     */
    public function active(Role $role)
    {
        $activated = $this->repository->switch($role->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Role $role
     * @return Response
     */
    public function destroy(Role $role)
    {
        $deleted = $this->repository->delete($role->id);
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
                    <a href="' . $role->url_backend->edit . '" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit">
                        <span class="svg-icon svg-icon-md">
                            ' . svg('icons/Communication/Write')->toHtml() . '
                        </span>
                    </a>
                    <form action="' . $role->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                            <span class="svg-icon svg-icon-md">
                                ' . svg('icons/General/Trash')->toHtml() . '
                            </span>
                        </button>
                    </form>
                ';
            })
            ->escapeColumns(['name', 'guard_name'])
            ->make(true);
    }
}
