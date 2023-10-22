<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Maatwebsite\Excel\Excel;
use Yajra\DataTables\DataTables;
use Modules\Core\Classes\Slim;
use Modules\Core\Entities\Domain;
use Modules\Core\Entities\User;
use Modules\Core\Entities\Role;
use Modules\Core\Exports\UserExport;
use Modules\Core\Forms\UserForm;
use Modules\Core\Repositories\ModelRepository;

class UserController extends Controller
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
     * UserController constructor.
     * @param User $user
     * @param FormBuilder $formBuilder
     */
    public function __construct(User $user, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');
        $this->middleware('can:User_edit')->only(['edit', 'update']);
        $this->middleware('can:User_create')->only(['create', 'store']);
        $this->middleware('can:User_delete')->only(['destroy']);

        $this->formBuilder = $formBuilder;
        $this->repository = new ModelRepository($user);
    }

    /**
     * Return the formBuilder
     * @param  User|null $user
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?User $user = null)
    {
        $user = $user ?: new User();
        return $this->formBuilder->create(UserForm::class, [
            'model' => $user
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('core::admin.user_index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('core::admin.user_form', compact('form'));
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
        $user = $this->repository->create($request->all());

        $user->roles()->sync($request->has('role') ? Role::whereIn('id', $request->get('role'))->get() : []);
        $user->domains()->sync($request->has('domain') ? Domain::whereIn('id', $request->get('domain'))->get() : []);

        Session::flash('success', 'L\'utilisateur a été créé avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.users.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Show the specified resource.
     * @param  User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('core::admin.user_show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $form = $this->getForm($user);
        $form->getField('role')->setValue($user->roles->pluck('id')->values()->toArray());
        $form->getField('domain')->setValue($user->domains->pluck('id')->values()->toArray());
        return view('core::admin.user_form', compact('form', 'user'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        $form = $this->getForm($user);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($user->id, $request->all());

        $user->roles()->sync($request->has('role') ? Role::whereIn('id', $request->get('role'))->get() : []);
        $user->domains()->sync($request->has('domain') ? Domain::whereIn('id', $request->get('domain'))->get() : []);

        if (!empty($request->slim)) {
            // Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
            $image = head(Slim::getImages());

            // Grab the ouput data (data modified after Slim has done its thing)
            if (isset($image['output']['data'])) {
                // Original file name
                $name = $image['output']['name'];
                $name = preg_replace('#(.*)\.(.*)#', 'users_avatar_' . $user->id . '.$2', $name);

                // Base64 of the image
                $data = $image['output']['data'];

                // Server path
                $path = base_path() . '/public/images/users/';

                // Save the file to the server
                $file = Slim::saveFile($data, $name, $path, false);

                // Get the absolute web path to the image
                $imagePath = asset('images/users/' . $file['name']);

                $user->avatar = $imagePath;
                $user->save();
            }
        }

        Session::flash('success', 'L\'utilisateur a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.users.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param User $user
     */
    public function active(User $user)
    {
        $activated = $this->repository->switch($user->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        $deleted = $this->repository->delete($user->id);
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
            $users = User::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $users = User::all();
        }
        return DataTables::of($users)
            ->addColumn('record_id', function($user) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="' . $user->id . '" />
                        </div>';
            })
            ->addColumn('user', function($user) {
                return $user->getFullnameAttribute() . '(' . $user->email . ')';
            })
            ->addColumn('user_display', function($user) {
                return '<div class="d-flex align-items-center">
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">' .
                                (!empty($user->avatar) ?
                                '<div class="symbol-label">
                                    <img src="' . $user->avatar . '" alt="' . $user->getFullnameAttribute() . '" class="w-100">
                                </div>' :
                                '<div class="symbol-label fs-3 bg-light-primary text-primary">' . substr($user->firstname, 0, 1) . '</div>') .
                            '</div>
                            <div class="d-flex flex-column">
                                <span class="text-gray-800 mb-1">' . $user->getFullnameAttribute() . '</span>
                                <span>' . $user->email . '</span>
                            </div>
                        </div>';
            })
            ->addColumn('role', function($user) {
                $roles = [];
                if (!empty($user->roles)) {
                    foreach ($user->roles as $key => $role) {
                        $roles[] = $role->name;
                    }
                }
                return implode(', ', $roles);
            })
            ->addColumn('role_display', function($user) {
                $roles = '';
                $colors = ['badge-light-primary', 'badge-light-success', 'badge-light-info', 'badge-light-warning', 'badge-light-danger', 'badge-light-dark'];
                if (!empty($user->roles)) {
                    foreach ($user->roles as $key => $role) {
                        $roles .= '<a href="' . $role->url_backend->edit . '" class="badge ' . $colors[$key % 6] . ' fs-7 m-1">' . $role->name . '</a>';
                    }
                }
                return $roles;
            })
            ->editColumn('created_at', function($user) {
                return date('d/m/Y', strtotime($user->created_at));
            })
            ->editColumn('last_login_at', function($user) {
                if (!empty($user->last_login_at)) {
                    return date('d/m/Y', strtotime($user->last_login_at));
                }
                return '';
            })
            ->editColumn('active', function($user) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                return ($user->active == 'Y' ? $label_on : $label_off);
            })
            ->addColumn('active_display', function($user) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $user->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $user->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.users_active', ['user' => $user->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn btn-sm min-w-100px ' . $class_btn . '"><i class="la ' . $class_i . '"></i>' . ($user->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($user) {
                $items = [];
                $items['edit'] = ['link' => $user->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $user->url_backend->destroy, 'label' => 'Delete'];
                $items = apply_filters('users_datatableactions', $items);
                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['firstname', 'lastname', 'email'])
            ->make(true);
    }

    public function export(Excel $excel, UserExport $export)
    {
        /*$users = User::all(); // All users
        $csvExporter = new \Laracsv\Export();
        $csv = $csvExporter->build($users, ['email', 'name'])->getCsv();
        return response((string)$csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition' => 'attachment; filename="users.csv"'
        ]);*/
        return $excel->download($export, 'users.csv');
    }
}
