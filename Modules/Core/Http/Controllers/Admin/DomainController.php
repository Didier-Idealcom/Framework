<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Core\Entities\Domain;
use Modules\Core\Forms\DomainForm;
use Modules\Core\Repositories\DomainRepository;
use Yajra\Datatables\Datatables;

class DomainController extends Controller
{
    /**
     * DomainController constructor.
     */
    public function __construct(Domain $domain, private FormBuilder $formBuilder, private DomainRepository $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('can:Domain_edit')->only(['edit', 'update']);
        $this->middleware('can:Domain_create')->only(['create', 'store']);
        $this->middleware('can:Domain_delete')->only(['destroy']);

        $this->repository->setModel($domain);
    }

    /**
     * Return the formBuilder
     */
    private function getForm(Domain $domain = null): DomainForm
    {
        $domain = $domain ? $domain : new Domain();

        return $this->formBuilder->create(DomainForm::class, [
            'model' => $domain,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('core::admin.domain_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();

        return view('core::admin.domain_form', compact('form'));
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

        $this->repository->create($request->all());

        Session::flash('success', 'Le domaine a été créé avec succès');

        $redirectOptions = [
            'save_close' => route('admin.domains.index'),
            'save_new' => route('admin.domains.create'),
            'save_stay' => url()->previous(),
        ];

        return redirect()->to($redirectOptions[$request->get('save')]);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show(Domain $domain)
    {
        return view('core::admin.domain_show', compact('domain'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Domain $domain)
    {
        $form = $this->getForm($domain);

        return view('core::admin.domain_form', compact('form', 'domain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request, Domain $domain)
    {
        $form = $this->getForm($domain);
        $form->redirectIfNotValid();

        $this->repository->update($domain->id, $request->all());

        Session::flash('success', 'Le domaine a été enregistré avec succès');

        $redirectOptions = [
            'save_close' => route('admin.domains.index'),
            'save_new' => route('admin.domains.create'),
            'save_stay' => url()->previous(),
        ];

        return redirect()->to($redirectOptions[$request->get('save')]);
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     */
    public function active(Domain $domain)
    {
        $this->repository->switch($domain->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Domain $domain)
    {
        $this->repository->delete($domain->id);

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
            $domains = Domain::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $domains = Domain::with('languages.language')->get();
        }

        return DataTables::of($domains)
            ->addColumn('record_id', function ($domain) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="'.$domain->id.'" />
                        </div>';
            })
            ->addColumn('row_details', function ($domain) {
                return view('core::admin.domain_subtable', compact('domain'));
            })
            ->addColumn('row_details_display', function () {
                return '<button type="button" class="btn btn-sm btn-icon btn-light-primary toggle h-25px w-25px trigger_row_details">
                            <i class="ki-duotone ki-plus fs-3 m-0 toggle-off"></i>
                            <i class="ki-duotone ki-minus fs-3 m-0 toggle-on"></i>
                        </button>';
            })
            ->editColumn('active', function ($domain) {
                $label_on = 'Actif';
                $label_off = 'Inactif';

                return $domain->active === 'Y' ? $label_on : $label_off;
            })
            ->addColumn('active_display', function ($domain) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $domain->active === 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $domain->active === 'Y' ? 'la-toggle-on' : 'la-toggle-off';

                return '<a href="javascript:;" data-url="'.route('admin.domains_active', ['domain' => $domain->id]).'" data-label-on="'.$label_on.'" data-label-off="'.$label_off.'" class="toggle-active btn btn-sm min-w-100px '.$class_btn.'"><i class="la '.$class_i.'"></i>'.($domain->active === 'Y' ? $label_on : $label_off).'</a>';
            })
            ->addColumn('actions', function ($domain) {
                $items = [];
                $items['edit'] = ['link' => $domain->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $domain->url_backend->destroy, 'label' => 'Delete'];
                $items = apply_filters('domains_datatableactions', $items);

                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['title', 'name', 'folder'])
            ->make(true);
    }
}
