<?php

namespace Modules\Domain\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Domain\Entities\Domain;
use Modules\Domain\Forms\DomainForm;
use Modules\Core\Repositories\CoreRepository;

class DomainController extends Controller
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
     * DomainController constructor.
     * @param Domain $domain
     * @param FormBuilder $formBuilder
     */
    public function __construct(Domain $domain, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new CoreRepository($domain);
    }

    /**
     * Return the formBuilder
     * @param  Domain|null $domain
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?Domain $domain = null)
    {
        $domain = $domain ?: new Domain();
        return $this->formBuilder->create(DomainForm::class, [
            'model' => $domain
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('domain::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('domain::admin.form', compact('form'));
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
        $domain = $this->repository->create($request->all());

        Session::flash('success', 'Le domaine a été créé avec succès');
        return redirect()->route('admin.domains.index');
    }

    /**
     * Show the specified resource.
     * @param  Domain $domain
     * @return Response
     */
    public function show(Domain $domain)
    {
        return view('domain::admin.show', compact('domain'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Domain $domain
     * @return Response
     */
    public function edit(Domain $domain)
    {
        $form = $this->getForm($domain);
        return view('domain::admin.form', compact('form', 'domain'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Domain $domain
     * @return Response
     */
    public function update(Request $request, Domain $domain)
    {
        $form = $this->getForm($domain);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($domain->id, $request->all());

        Session::flash('success', 'Le domaine a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.domains.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.domains.index');
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param Domain $domain
     */
    public function active(Domain $domain)
    {
        $activated = $this->repository->active($domain->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Domain $domain
     * @return Response
     */
    public function destroy(Domain $domain)
    {
        $deleted = $this->repository->delete($domain->id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        return Datatables::of(Domain::all())
            ->editColumn('active', function($domain) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $domain->active == 'Y' ? 'btn-success' : 'btn-danger';
                $class_i = $domain->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.domains_active', ['domain' => $domain->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn m-btn ' . $class_btn . ' m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la ' . $class_i . '"></i> &nbsp; ' . ($domain->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($domain) {
                return '
                    <a href="' . $domain->url_backend->edit . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $domain->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md" aria-label="Delete"><i class="la la-trash"></i></button>
                    </form>
                ';
            })
            ->escapeColumns(['title', 'name', 'folder'])
            ->make(true);
    }
}
