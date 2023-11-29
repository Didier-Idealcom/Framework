<?php

namespace Modules\Email\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Email\Entities\Email;
use Modules\Email\Forms\EmailForm;
use Modules\Email\Repositories\EmailRepository;
use Yajra\Datatables\Datatables;

class EmailController extends Controller
{
    /**
     * EmailController constructor.
     */
    public function __construct(Email $email, private FormBuilder $formBuilder, private EmailRepository $repository)
    {
        $this->middleware('auth:admin');

        $this->repository->setModel($email);
    }

    /**
     * Return the formBuilder
     */
    private function getForm(Email $email = null): EmailForm
    {
        $email = $email ? $email : new Email();

        return $this->formBuilder->create(EmailForm::class, [
            'model' => $email,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('email::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();

        return view('email::admin.form', compact('form'));
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

        $email = $this->repository->create($request->all());

        // Création de l'e-mail
        Artisan::call('module:make-mail '.$email->name.'Email '.$email->module);

        Session::flash('success', 'L\'e-mail a été créé avec succès');

        $redirectOptions = [
            'save_close' => route('admin.emails.index'),
            'save_new' => route('admin.emails.create'),
            'save_stay' => url()->previous(),
        ];

        return redirect()->to($redirectOptions[$request->get('save')]);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show(Email $email)
    {
        return view('email::admin.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Email $email)
    {
        $form = $this->getForm($email);

        return view('email::admin.form', compact('form', 'email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request, Email $email)
    {
        $form = $this->getForm($email);
        $form->redirectIfNotValid();

        $this->repository->update($email->id, $request->all());

        Session::flash('success', 'L\'e-mail a été enregistré avec succès');

        $redirectOptions = [
            'save_close' => route('admin.emails.index'),
            'save_new' => route('admin.emails.create'),
            'save_stay' => url()->previous(),
        ];

        return redirect()->to($redirectOptions[$request->get('save')]);
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     */
    public function active(Email $email)
    {
        $this->repository->switch($email->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Email $email)
    {
        $this->repository->delete($email->id);

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
            $emails = Email::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $emails = Email::all();
        }

        return DataTables::of($emails)
            ->addColumn('record_id', function ($email) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="'.$email->id.'" />
                        </div>';
            })
            ->editColumn('active', function ($email) {
                $label_on = 'Actif';
                $label_off = 'Inactif';

                return $email->active === 'Y' ? $label_on : $label_off;
            })
            ->addColumn('active_display', function ($email) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $email->active === 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $email->active === 'Y' ? 'la-toggle-on' : 'la-toggle-off';

                return '<a href="javascript:;" data-url="'.route('admin.emails_active', ['email' => $email->id]).'" data-label-on="'.$label_on.'" data-label-off="'.$label_off.'" class="toggle-active btn btn-sm min-w-100px '.$class_btn.'"><i class="la '.$class_i.'"></i>'.($email->active === 'Y' ? $label_on : $label_off).'</a>';
            })
            ->addColumn('actions', function ($email) {
                $items = [];
                $items['edit'] = ['link' => $email->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $email->url_backend->destroy, 'label' => 'Delete'];
                $items = apply_filters('emails_datatableactions', $items);

                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['name', 'module'])
            ->make(true);
    }
}
