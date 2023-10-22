<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Core\Entities\Role;
use Modules\Core\Entities\Permission;
use Modules\Core\Forms\RoleForm;
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
        $this->middleware('can:Role_edit')->only(['edit', 'update']);
        $this->middleware('can:Role_create')->only(['create', 'store']);
        $this->middleware('can:Role_delete')->only(['destroy']);

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
        $roles = Role::all();
        return view('core::admin.role_index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('core::admin.role_form', compact('form'));
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

        $role->syncPermissions($request->has('permission') ? Permission::whereIn('id', $request->get('permission'))->get() : []);

        Session::flash('success', 'Le rôle a été créé avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.roles.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the specified resource.
     * @param  Role $role
     * @return Response
     */
    public function show(Role $role)
    {
        return view('core::admin.role_show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Role $role
     * @return Response
     */
    public function edit(Role $role)
    {
        $form = $this->getForm($role);
        $form->getField('permission')->setValue($role->permissions->pluck('id')->values()->toArray());
        return view('core::admin.role_form', compact('form', 'role'));
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
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        if ($request->sort) {
            $roles = Role::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $roles = Role::all();
        }
        return DataTables::of($roles)
            ->addColumn('record_id', function($role) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="' . $role->id . '" />
                        </div>';
            })
            ->editColumn('created_at', function($role) {
                return date('d/m/Y', strtotime($role->created_at));
            })
            ->addColumn('actions', function($role) {
                $items = [];
                $items['edit'] = ['link' => $role->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $role->url_backend->destroy, 'label' => 'Delete'];
                $items = apply_filters('roles_datatableactions', $items);
                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['name', 'guard_name'])
            ->make(true);
    }
}
