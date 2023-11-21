<?php

namespace Modules\Formulaire\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Core\Repositories\RepositoryInterface;
use Modules\Formulaire\Entities\Formulaire;
use Modules\Formulaire\Forms\FormulaireForm;
use Modules\Formulaire\Forms\FormulairePreviewForm;
use Yajra\Datatables\Datatables;

class FormulaireController extends Controller
{
    /**
     * FormulaireController constructor.
     */
    public function __construct(Formulaire $formulaire, private FormBuilder $formBuilder, protected RepositoryInterface $repository)
    {
        $this->middleware('auth:admin');

        $this->repository->setModel($formulaire);
    }

    /**
     * Return the formBuilder
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(Formulaire $formulaire = null)
    {
        $formulaire = $formulaire ?: new Formulaire();

        return $this->formBuilder->create(FormulaireForm::class, [
            'model' => $formulaire,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('formulaire::admin.formulaire_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();

        return view('formulaire::admin.formulaire_form', compact('form'));
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
        $formulaire = $this->repository->create($request->all());

        Session::flash('success', 'Le formulaire a été créé avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.formulaires.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }

        return redirect()->route('admin.formulaires.index');
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show(Formulaire $formulaire)
    {
        $form = $this->formBuilder->create(FormulairePreviewForm::class, [
            'model' => $formulaire,
        ]);

        return view('formulaire::admin.formulaire_show', compact('formulaire', 'form'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Formulaire $formulaire)
    {
        $form = $this->getForm($formulaire);

        return view('formulaire::admin.formulaire_form', compact('form', 'formulaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request, Formulaire $formulaire)
    {
        $form = $this->getForm($formulaire);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($formulaire->id, $request->all());

        Session::flash('success', 'Le formulaire a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.formulaires.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }

        return redirect()->route('admin.formulaires.index');
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     */
    public function active(Formulaire $formulaire)
    {
        $activated = $this->repository->switch($formulaire->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Formulaire $formulaire)
    {
        $deleted = $this->repository->delete($formulaire->id);

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
            $formualires = Formulaire::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $formualires = Formulaire::all();
        }

        return DataTables::of($formualires)
            ->addColumn('record_id', function ($formulaire) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="'.$formulaire->id.'" />
                        </div>';
            })
            ->editColumn('active', function ($formulaire) {
                $label_on = 'Actif';
                $label_off = 'Inactif';

                return $formulaire->active == 'Y' ? $label_on : $label_off;
            })
            ->addColumn('active_display', function ($formulaire) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $formulaire->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $formulaire->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';

                return '<a href="javascript:;" data-url="'.route('admin.formulaires_active', ['formulaire' => $formulaire->id]).'" data-label-on="'.$label_on.'" data-label-off="'.$label_off.'" class="toggle-active btn btn-sm min-w-100px '.$class_btn.'"><i class="la '.$class_i.'"></i>'.($formulaire->active == 'Y' ? $label_on : $label_off).'</a>';
            })
            ->addColumn('actions', function ($formulaire) {
                $items = [];
                $items['edit'] = ['link' => $formulaire->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $formulaire->url_backend->destroy, 'label' => 'Delete'];
                $items['more'][] = ['link' => $formulaire->url_backend->show, 'label' => 'Preview'];
                $items['more'][] = ['link' => route('admin.formulaires_fields.index', $formulaire->id), 'label' => 'Champs'];
                $items = apply_filters('formulaires_datatableactions', $items);

                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
