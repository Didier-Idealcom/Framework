<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\User\Entities\User;
use Modules\User\Forms\UserForm;
use Modules\User\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * @var FormBuilder
     */
    private $formBuilder;

    /**
     * @var UserRepository
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
        $this->repository = new UserRepository($user);
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
        $users = $this->repository->load(10);
        return view('user::admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('user::admin.form', compact('form'));
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
        return view('user::admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $form = $this->getForm($user);
        return view('user::admin.form', compact('form'));
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
        //$user->save();
        $user = $this->repository->update($id, $request->all());
        return redirect()->route('admin.users.index');
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
        return Datatables::of(User::all())
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
}
