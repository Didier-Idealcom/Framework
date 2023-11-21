<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Core\Entities\Permission;
use Modules\Core\Forms\PermissionForm;
use Modules\Core\Repositories\RepositoryInterface;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{
    /**
     * PermissionController constructor.
     */
    public function __construct(Permission $permission, private FormBuilder $formBuilder, protected RepositoryInterface $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('can:Permission_edit')->only(['edit', 'update']);
        $this->middleware('can:Permission_create')->only(['create', 'store']);
        $this->middleware('can:Permission_delete')->only(['destroy']);

        $this->repository->setModel($permission);
    }

    /**
     * Return the formBuilder
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(Permission $permission = null)
    {
        $permission = $permission ?: new Permission();

        return $this->formBuilder->create(PermissionForm::class, [
            'model' => $permission,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('core::admin.permission_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();

        return view('core::admin.permission_form', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
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
     *
     * @return Response
     */
    public function show(Permission $permission)
    {
        return view('core::admin.permission_show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Permission $permission)
    {
        $form = $this->getForm($permission);

        return view('core::admin.permission_form', compact('form', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
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
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Permission $permission)
    {
        $deleted = $this->repository->delete($permission->id);

        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     *
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
            ->addColumn('record_id', function ($permission) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="'.$permission->id.'" />
                        </div>';
            })
            ->addColumn('assigned_to', function ($permission) {
                $roles = [];
                if (! empty($permission->roles)) {
                    foreach ($permission->roles as $key => $role) {
                        $roles[] = $role->name;
                    }
                }

                return implode(', ', $roles);
            })
            ->addColumn('assigned_to_display', function ($permission) {
                $roles = '';
                $colors = ['badge-light-primary', 'badge-light-success', 'badge-light-info', 'badge-light-warning', 'badge-light-danger', 'badge-light-dark'];
                if (! empty($permission->roles)) {
                    foreach ($permission->roles as $key => $role) {
                        $roles .= '<a href="'.$role->url_backend->edit.'" class="badge '.$colors[$key % 6].' fs-7 m-1">'.$role->name.'</a>';
                    }
                }

                return $roles;
            })
            ->editColumn('created_at', function ($permission) {
                return date('d/m/Y', strtotime($permission->created_at));
            })
            ->addColumn('actions', function ($permission) {
                $items = [];
                $items['edit'] = ['link' => $permission->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $permission->url_backend->destroy, 'label' => 'Delete'];
                $items = apply_filters('permissions_datatableactions', $items);

                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['name', 'guard_name'])
            ->make(true);
    }
}
