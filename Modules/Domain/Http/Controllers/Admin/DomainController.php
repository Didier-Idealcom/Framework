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
use Modules\Domain\Repositories\DomainRepository;

class DomainController extends Controller
{
    /**
     * @var FormBuilder
     */
    private $formBuilder;

    /**
     * @var DomainRepository
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
        $this->repository = new DomainRepository($domain);
    }

    /**
     * Return the formBuilder
     * @param Domain|null $domain
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
        $domains = $this->repository->load(10);
        return view('domain::admin.index', compact('domains'));
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
        return redirect()->route('admin.domains.index');
    }

    /**
     * Show the specified resource.
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $domain = $this->repository->find($id);
        return view('domain::admin.show', compact('domain'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Domain $domain
     * @return Response
     */
    public function edit(Domain $domain)
    {
        $form = $this->getForm($domain);
        return view('domain::admin.form', compact('form'));
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
        $domain = $this->repository->update($id, $request->all());
        Session::flash('success', 'Le domaine a été enregistré avec succès');
        return redirect()->route('admin.domains.index');
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
        return Datatables::of(Domain::all())
            ->editColumn('active', function($domain) {
                return $domain->active == 'Y' ? '<a href="#" class="btn m-btn btn-success m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-on"></i> &nbsp; Actif</a>' : '<a href="#" class="btn m-btn btn-danger m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-off"></i> &nbsp; Inactif</a>';
            })
            ->addColumn('actions', function($domain) {
                return '
                    <a href="' . $domain->url_backend->edit . '" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $domain->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                    </form>
                ';
            })
            ->escapeColumns(['title', 'name', 'folder'])
            ->make(true);
    }
}
