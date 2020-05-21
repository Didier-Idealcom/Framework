<?php

namespace Modules\Language\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Language\Entities\Language;
use Modules\Language\Forms\LanguageForm;
use Modules\Core\Repositories\ModelRepository;

class LanguageController extends Controller
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
     * LanguageController constructor.
     * @param Language $language
     * @param FormBuilder $formBuilder
     */
    public function __construct(Language $language, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new ModelRepository($language);
    }

    /**
     * Return the formBuilder
     * @param  Language|null $language
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?Language $language = null)
    {
        $language = $language ?: new Language();
        return $this->formBuilder->create(LanguageForm::class, [
            'model' => $language
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('language::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('language::admin.form', compact('form'));
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
        $language = $this->repository->create($request->all());

        Session::flash('success', 'La langue a été créée avec succès');
        return redirect()->route('admin.languages.index');
    }

    /**
     * Show the specified resource.
     * @param  Language $language
     * @return Response
     */
    public function show(Language $language)
    {
        return view('language::admin.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Language $language
     * @return Response
     */
    public function edit(Language $language)
    {
        $form = $this->getForm($language);
        return view('language::admin.form', compact('form', 'language'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Language $language
     * @return Response
     */
    public function update(Request $request, Language $language)
    {
        $form = $this->getForm($language);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($language->id, $request->all());

        Session::flash('success', 'La langue a été enregistrée avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.languages.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.languages.index');
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param Language $language
     */
    public function active(Language $language)
    {
        $activated = $this->repository->switch($language->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Language $language
     * @return Response
     */
    public function destroy(Language $language)
    {
        $deleted = $this->repository->delete($language->id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        return Datatables::of(Language::all())
            ->editColumn('active', function($language) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $language->active == 'Y' ? 'btn-success' : 'btn-danger';
                $class_i = $language->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.languages_active', ['language' => $language->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn m-btn ' . $class_btn . ' m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la ' . $class_i . '"></i> &nbsp; ' . ($language->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($language) {
                return '
                    <a href="' . $language->url_backend->edit . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $language->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md" aria-label="Delete"><i class="la la-trash"></i></button>
                    </form>
                ';
            })
            ->escapeColumns(['alpha2', 'name'])
            ->make(true);
    }
}
