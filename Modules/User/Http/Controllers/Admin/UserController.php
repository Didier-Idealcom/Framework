<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Maatwebsite\Excel\Excel;
use Yajra\Datatables\Datatables;
use Modules\User\Entities\User;
use Modules\User\Entities\Role;
use Modules\User\Forms\UserForm;
use Modules\User\Exports\UserExport;
use Modules\Core\Classes\Slim;
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
        return view('user::admin.user_index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('user::admin.user_form', compact('form'));
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

        Session::flash('success', 'L\'utilisateur a été créé avec succès');
        return redirect()->route('admin.users.index');
    }

    /**
     * Show the specified resource.
     * @param  User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('user::admin.user_show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $form = $this->getForm($user);
        $form->getField('role')->setValue($user->roles->pluck('id')->values());
        return view('user::admin.user_form', compact('form', 'user'));
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

        $user->syncRoles($request->has('role') ? Role::whereIn('id', $request->get('role'))->get() : []);

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
        return Datatables::of($users)
            ->editColumn('active', function($user) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $user->active == 'Y' ? 'btn-success' : 'btn-danger';
                $class_i = $user->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.users_active', ['user' => $user->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn m-btn ' . $class_btn . ' m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la ' . $class_i . '"></i> &nbsp; ' . ($user->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->editColumn('created_at', function($user) {
                return date('d/m/Y', strtotime($user->created_at));
            })
            ->addColumn('actions', function($user) {
                return '
                    <a href="' . $user->url_backend->edit . '" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit">
                        <span class="svg-icon svg-icon-md">
                            ' . svg(theme_url('media/svg/icons/Communication/') . 'Write') . '
                        </span>
                    </a>
                    <form action="' . $user->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                            <span class="svg-icon svg-icon-md">
                                ' . svg(theme_url('media/svg/icons/General/') . 'Trash') . '
                            </span>
                        </button>
                    </form>
                ';
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
