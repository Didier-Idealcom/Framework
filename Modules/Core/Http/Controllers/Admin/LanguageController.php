<?php

namespace Modules\Core\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Core\Entities\Language;
use Modules\Core\Forms\LanguageForm;
use Modules\Core\Repositories\RepositoryInterface;
use Yajra\Datatables\Datatables;

class LanguageController extends Controller
{
    /**
     * LanguageController constructor.
     */
    public function __construct(Language $language, private FormBuilder $formBuilder, protected RepositoryInterface $repository)
    {
        $this->middleware('auth:admin');
        $this->middleware('can:Language_edit')->only(['edit', 'update']);
        $this->middleware('can:Language_create')->only(['create', 'store']);
        $this->middleware('can:Language_delete')->only(['destroy']);

        $this->repository->setModel($language);
    }

    /**
     * Return the formBuilder
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(Language $language = null)
    {
        $language = $language ?: new Language();

        return $this->formBuilder->create(LanguageForm::class, [
            'model' => $language,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('core::admin.language_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();

        return view('core::admin.language_form', compact('form'));
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
        $language = $this->repository->create($request->all());

        Session::flash('success', 'La langue a été créée avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.languages.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }

        return redirect()->route('admin.languages.index');
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show(Language $language)
    {
        return view('core::admin.language_show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Language $language)
    {
        $form = $this->getForm($language);

        return view('core::admin.language_form', compact('form', 'language'));
    }

    /**
     * Update the specified resource in storage.
     *
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
     */
    public function active(Language $language)
    {
        $activated = $this->repository->switch($language->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Language $language)
    {
        $deleted = $this->repository->delete($language->id);

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
            $languages = Language::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $languages = Language::all();
        }

        return DataTables::of($languages)
            ->addColumn('record_id', function ($language) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="'.$language->id.'" />
                        </div>';
            })
            ->editColumn('active', function ($language) {
                $label_on = 'Actif';
                $label_off = 'Inactif';

                return $language->active == 'Y' ? $label_on : $label_off;
            })
            ->addColumn('active_display', function ($language) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $language->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $language->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';

                return '<a href="javascript:;" data-url="'.route('admin.languages_active', ['language' => $language->id]).'" data-label-on="'.$label_on.'" data-label-off="'.$label_off.'" class="toggle-active btn btn-sm min-w-100px '.$class_btn.'"><i class="la '.$class_i.'"></i>'.($language->active == 'Y' ? $label_on : $label_off).'</a>';
            })
            ->addColumn('actions', function ($language) {
                $items = [];
                $items['edit'] = ['link' => $language->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $language->url_backend->destroy, 'label' => 'Delete'];
                $items = apply_filters('languages_datatableactions', $items);

                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['alpha2', 'name'])
            ->make(true);
    }
}
