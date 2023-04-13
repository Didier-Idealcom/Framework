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
use Modules\Core\Repositories\ModelRepository;

class DomainController extends Controller
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
     * DomainController constructor.
     * @param Domain $domain
     * @param FormBuilder $formBuilder
     */
    public function __construct(Domain $domain, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new ModelRepository($domain);
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
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.domains.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
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
        $activated = $this->repository->switch($domain->id);
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
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        if ($request->sort) {
            $domains = Domain::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $domains = Domain::all();
        }
        return DataTables::of($domains)
            ->addColumn('record_id', function($domain) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="' . $domain->id . '" />
                        </div>';
            })
            ->editColumn('active', function($domain) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                return ($domain->active == 'Y' ? $label_on : $label_off);
            })
            ->addColumn('active_display', function($domain) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $domain->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $domain->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.domains_active', ['domain' => $domain->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn btn-sm min-w-100px ' . $class_btn . '"><i class="la ' . $class_i . '"></i>' . ($domain->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($domain) {
                $items = [];
                $items['edit'] = ['link' => $domain->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $domain->url_backend->destroy, 'label' => 'Delete'];
                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['title', 'name', 'folder'])
            ->make(true);
    }
}
