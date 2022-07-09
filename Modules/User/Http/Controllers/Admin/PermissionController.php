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
use Modules\Core\Repositories\ModelRepository;

class PermissionController extends Controller
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
     * PermissionController constructor.
     * @param Permission $permission
     * @param FormBuilder $formBuilder
     */
    public function __construct(Permission $permission, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new ModelRepository($permission);
    }

    /**
     * Return the formBuilder
     * @param  Permission|null $permission
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
        return view('user::admin.permission_index');
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

        Session::flash('success', 'La permission a été créée avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.permissions.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Show the specified resource.
     * @param  Permission $permission
     * @return Response
     */
    public function show(Permission $permission)
    {
        return view('user::admin.permission_show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Permission $permission
     * @return Response
     */
    public function edit(Permission $permission)
    {
        $form = $this->getForm($permission);
        return view('user::admin.permission_form', compact('form', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Permission $permission
     * @return Response
     */
    public function update(Request $request, Permission $permission)
    {
        $form = $this->getForm($permission);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($permission->id, $request->all());

        Session::flash('success', 'La permission a été enregistrée avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.permissions.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param Permission $permission
     */
    public function active(Permission $permission)
    {
        $activated = $this->repository->switch($permission->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Permission $permission
     * @return Response
     */
    public function destroy(Permission $permission)
    {
        $deleted = $this->repository->delete($permission->id);
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
            $permissions = Permission::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $permissions = Permission::all();
        }
        return DataTables::of($permissions)
            ->addColumn('record_id', function($permission) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="' . $permission->id . '" />
                        </div>';
            })
            ->addColumn('assigned_to', function($permission) {
                $roles = '';
                $colors = ['badge-light-primary', 'badge-light-success', 'badge-light-info', 'badge-light-warning', 'badge-light-danger', 'badge-light-dark'];
                if (!empty($permission->roles)) {
                    foreach ($permission->roles as $key => $role) {
                        $roles .= '<a href="' . $role->url_backend->edit . '" class="badge ' . $colors[$key % 6] . ' fs-7 m-1">' . $role->name . '</a>';
                    }
                }
                return $roles;
            })
            ->editColumn('created_at', function($permission) {
                return date('d/m/Y', strtotime($permission->created_at));
            })
            ->addColumn('actions', function($permission) {
                return '<div class="min-w-80px">
                            <a href="' . $permission->url_backend->edit . '" class="btn btn-sm btn-icon btn-light-primary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <span class="svg-icon svg-icon-2">
                                    ' . purifySvg(svg('icons/Communication/Write')) . '
                                </span>
                            </a>
                            <form action="' . $permission->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                                ' . method_field("DELETE") . '
                                ' . csrf_field() . '
                                <button class="btn btn-sm btn-icon btn-light-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <span class="svg-icon svg-icon-2">
                                        ' . purifySvg(svg('icons/General/Trash')) . '
                                    </span>
                                </button>
                            </form>
                        </div>';
            })
            ->escapeColumns(['name', 'guard_name'])
            ->make(true);
    }
}
