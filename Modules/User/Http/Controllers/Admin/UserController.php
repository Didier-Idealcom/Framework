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
use Modules\Core\Repositories\CoreRepository;

class UserController extends Controller
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
     * UserController constructor.
     * @param User $user
     * @param FormBuilder $formBuilder
     */
    public function __construct(User $user, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new CoreRepository($user);
    }

    /**
     * Return the formBuilder
     * @param User|null $user
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
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->repository->find($id);
        return view('user::admin.user_show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $form = $this->getForm($user);
        $form->getField('role')->setValue($user->roles->pluck('id')->values());
        return view('user::admin.user_form', compact('form'));
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
        $updated = $this->repository->update($id, $request->all());

        $user = $this->repository->find($id);
        $user->syncRoles($request->has('role') ? Role::whereIn('id', $request->get('role'))->get() : []);

        Session::flash('success', 'L\'utilisateur a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.users.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        return Datatables::of(User::all())
            ->editColumn('active', function($user) {
                return $user->active == 'Y' ? '<a href="#" class="btn m-btn btn-success m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-on"></i> &nbsp; Actif</a>' : '<a href="#" class="btn m-btn btn-danger m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-off"></i> &nbsp; Inactif</a>';
            })
            ->addColumn('actions', function($user) {
                return '
                    <a href="' . $user->url_backend->edit . '" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $user->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                    </form>
                ';
            })
            ->escapeColumns(['name', 'email'])
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
