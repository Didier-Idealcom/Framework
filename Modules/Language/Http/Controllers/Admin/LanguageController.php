<?php

namespace Modules\Language\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Language\Entities\Language;
use Modules\Language\Forms\LanguageForm;
use Modules\Language\Repositories\LanguageRepository;

class LanguageController extends Controller
{
    /**
     * @var FormBuilder
     */
    private $formBuilder;

    /**
     * @var LanguageRepository
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
        $this->repository = new LanguageRepository($language);
    }

    /**
     * Return the formBuilder
     * @param Language|null $language
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
        $languages = $this->repository->load(10);
        return view('language::admin.index', compact('languages'));
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
        return redirect()->route('admin.languages.index');
    }

    /**
     * Show the specified resource.
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $language = $this->repository->find($id);
        return view('language::admin.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Language $language
     * @return Response
     */
    public function edit(Language $language)
    {
        $form = $this->getForm($language);
        return view('language::admin.form', compact('form'));
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
        //$language->save();
        $language = $this->repository->update($id, $request->all());
        return redirect()->route('admin.languages.index');
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
        return Datatables::of(Language::all())
            ->addColumn('actions', function($language) {
                return '
                    <a href="' . $language->url_backend->edit . '" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $language->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                    </form>
                ';
            })
            ->escapeColumns(['alpha2', 'name'])
            ->make(true);
    }
}
