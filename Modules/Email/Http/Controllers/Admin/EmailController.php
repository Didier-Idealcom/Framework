<?php

namespace Modules\Email\Http\Controllers\Admin;

use \Artisan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Email\Entities\Email;
use Modules\Email\Forms\EmailForm;
use Modules\Core\Repositories\ModelRepository;

class EmailController extends Controller
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
     * EmailController constructor.
     * @param Email $email
     * @param FormBuilder $formBuilder
     */
    public function __construct(Email $email, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new ModelRepository($email);
    }

    /**
     * Return the formBuilder
     * @param  Email|null $email
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?Email $email = null)
    {
        $email = $email ?: new Email();
        return $this->formBuilder->create(EmailForm::class, [
            'model' => $email
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('email::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('email::admin.form', compact('form'));
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
        $email = $this->repository->create($request->all());

        // Création de l'e-mail
        Artisan::call('module:make-mail ' . $email->name . 'Email ' . $email->module);

        Session::flash('success', 'L\'e-mail a été créé avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.emails.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.emails.index');
    }

    /**
     * Show the specified resource.
     * @param  Email $email
     * @return Response
     */
    public function show(Email $email)
    {
        return view('email::admin.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Email $email
     * @return Response
     */
    public function edit(Email $email)
    {
        $form = $this->getForm($email);
        return view('email::admin.form', compact('form', 'email'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Email $email
     * @return Response
     */
    public function update(Request $request, Email $email)
    {
        $form = $this->getForm($email);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($email->id, $request->all());

        Session::flash('success', 'L\'e-mail a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.emails.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.emails.index');
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param Email $email
     */
    public function active(Email $email)
    {
        $activated = $this->repository->switch($email->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Email $email
     * @return Response
     */
    public function destroy(Email $email)
    {
        $deleted = $this->repository->delete($email->id);
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
            $emails = Email::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $emails = Email::all();
        }
        return DataTables::of($emails)
            ->addColumn('record_id', function($email) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="' . $email->id . '" />
                        </div>';
            })
            ->editColumn('active', function($email) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                return ($email->active == 'Y' ? $label_on : $label_off);
            })
            ->addColumn('active_display', function($email) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $email->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $email->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.emails_active', ['email' => $email->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn btn-sm min-w-100px ' . $class_btn . '"><i class="la ' . $class_i . '"></i>' . ($email->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($email) {
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
