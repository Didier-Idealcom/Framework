<?php

namespace Modules\Domain\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Domain\Entities\Domain;
use Modules\Domain\Entities\DomainLanguage;
use Modules\Domain\Forms\DomainLanguageForm;
use Modules\Core\Repositories\ModelRepository;

class DomainLanguageController extends Controller
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
     * @param DomainLanguage $domain_language
     * @param FormBuilder $formBuilder
     */
    public function __construct(DomainLanguage $domain_language, FormBuilder $formBuilder, Request $request)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->request = $request;
        $this->repository = new ModelRepository($domain_language);
    }

    /**
     * Return the formBuilder
     * @param  DomainLanguage|null $domain_language
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?DomainLanguage $domain_language = null)
    {
        $domain_language = $domain_language ?: new DomainLanguage();
        return $this->formBuilder->create(DomainLanguageForm::class, [
            'model' => $domain_language
        ]);
    }

    /**
     * Display a listing of the resource.
     * @param  Domain $domain
     * @return Response
     */
    public function index(Domain $domain)
    {
        return view('domain::admin.domain_language_index', compact('domain'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  Domain $domain
     * @return Response
     */
    public function create(Domain $domain)
    {
        $form = $this->getForm();
        return view('domain::admin.domain_language_form', compact('form', 'domain'));
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
        $domain_language = $this->repository->create($request->all());

        Session::flash('success', 'La langue du domaine a été créée avec succès');
        return redirect()->route('admin.domains_languages.index', $domain_language->domain_id);
    }

    /**
     * Show the specified resource.
     * @param  DomainLanguage $domain_language
     * @return Response
     */
    public function show(DomainLanguage $domain_language)
    {
        return view('domain::admin.domain_language_show', compact('domain_language'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  DomainLanguage $domain_language
     * @return Response
     */
    public function edit(DomainLanguage $domain_language)
    {
        $form = $this->getForm($domain_language);
        $domain = $domain_language->domain;
        return view('domain::admin.domain_language_form', compact('form', 'domain', 'domain_language'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  DomainLanguage $domain_language
     * @return Response
     */
    public function update(Request $request, DomainLanguage $domain_language)
    {
        $form = $this->getForm($domain_language);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($domain_language->id, $request->all());

        Session::flash('success', 'La langue du domaine a été enregistrée avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.domains_languages.create', $request->get('domain_id'));
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.domains_languages.index', $request->get('domain_id'));
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param DomainLanguage $domain_language
     */
    public function active(DomainLanguage $domain_language)
    {
        $activated = $this->repository->switch($domain_language->id);
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param DomainLanguage $domain_language
     */
    public function default(DomainLanguage $domain_language)
    {
        $activated = $this->repository->switchDefault($domain_language->id, 'domain_id');
    }

    /**
     * Remove the specified resource from storage.
     * @param  DomainLanguage $domain_language
     * @return Response
     */
    public function destroy(DomainLanguage $domain_language)
    {
        $deleted = $this->repository->delete($domain_language->id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @param  Domain $domain
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Domain $domain)
    {
        return Datatables::of(DomainLanguage::all()->where('domain_id', $domain->id))
            ->editColumn('active', function($domain_language) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $domain_language->active == 'Y' ? 'btn-success' : 'btn-danger';
                $class_i = $domain_language->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.domains_languages_active', ['domain_language' => $domain_language->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn m-btn ' . $class_btn . ' m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la ' . $class_i . '"></i> &nbsp; ' . ($domain_language->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->editColumn('default', function($domain_language) {
                $label_on = 'Défaut';
                $label_off = 'Inactif';
                $class_btn = $domain_language->default == 'Y' ? 'btn-success' : 'btn-danger';
                $class_i = $domain_language->default == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.domains_languages_default', ['domain_language' => $domain_language->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" data-reload="true" class="toggle-active btn m-btn ' . $class_btn . ' m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la ' . $class_i . '"></i> &nbsp; ' . ($domain_language->default == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('language', function($domain_language) {
                return $domain_language->language->name;
            })
            ->addColumn('actions', function($domain_language) {
                return '
                    <a href="' . $domain_language->url_backend->edit . '" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit">
                        <span class="svg-icon svg-icon-md">
                            ' . svg('icons/Communication/Write')->toHtml() . '
                        </span>
                    </a>
                    <form action="' . $domain_language->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                            <span class="svg-icon svg-icon-md">
                                ' . svg('icons/General/Trash')->toHtml() . '
                            </span>
                        </button>
                    </form>
                ';
            })
            ->escapeColumns(['language'])
            ->make(true);
    }
}
