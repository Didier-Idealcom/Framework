<?php

namespace Modules\Formulaire\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Formulaire\Entities\Formulaire;
use Modules\Formulaire\Entities\FormulaireField;
use Modules\Formulaire\Forms\FormulaireFieldForm;
use Modules\Core\Repositories\ModelRepository;

class FormulaireFieldController extends Controller
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
     * FormulaireFieldController constructor.
     * @param FormulaireField $formulaire_field
     * @param FormBuilder $formBuilder
     */
    public function __construct(FormulaireField $formulaire_field, FormBuilder $formBuilder, Request $request)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->request = $request;
        $this->repository = new ModelRepository($formulaire_field);
    }

    /**
     * Return the formBuilder
     * @param  FormulaireField|null $formulaire_field
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?FormulaireField $formulaire_field = null)
    {
        $formulaire_field = $formulaire_field ?: new FormulaireField();
        return $this->formBuilder->create(FormulaireFieldForm::class, [
            'model' => $formulaire_field
        ]);
    }

    /**
     * Display a listing of the resource.
     * @param  Formulaire $formulaire
     * @return Response
     */
    public function index(Formulaire $formulaire)
    {
        return view('formulaire::admin.formulaire_field_index', compact('formulaire'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  Formulaire $formulaire
     * @return Response
     */
    public function create(Formulaire $formulaire)
    {
        $form = $this->getForm();
        return view('formulaire::admin.formulaire_field_form', compact('form', 'formulaire'));
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
        $formulaire_field = $this->repository->create($request->all());

        Session::flash('success', 'Le champ de formulaire a été créé avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.formulaires_fields.create', $request->get('formulaire_id'));
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.formulaires_fields.index', $formulaire_field->formulaire_id);
    }

    /**
     * Show the specified resource.
     * @param  FormulaireField $formulaire_field
     * @return Response
     */
    public function show(FormulaireField $formulaire_field)
    {
        return view('formulaire::admin.formulaire_field_show', compact('formulaire_field'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  FormulaireField $formulaire_field
     * @return Response
     */
    public function edit(FormulaireField $formulaire_field)
    {
        $form = $this->getForm($formulaire_field);
        $formulaire = $formulaire_field->formulaire;
        return view('formulaire::admin.formulaire_field_form', compact('form', 'formulaire', 'formulaire_field'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  FormulaireField $formulaire_field
     * @return Response
     */
    public function update(Request $request, FormulaireField $formulaire_field)
    {
        $form = $this->getForm($formulaire_field);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($formulaire_field->id, $request->all());

        Session::flash('success', 'Le champ de formulaire a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.formulaires_fields.create', $request->get('formulaire_id'));
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.formulaires_fields.index', $request->get('formulaire_id'));
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param FormulaireField $formulaire_field
     */
    public function active(FormulaireField $formulaire_field)
    {
        $activated = $this->repository->switch($formulaire_field->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  FormulaireField $formulaire_field
     * @return Response
     */
    public function destroy(FormulaireField $formulaire_field)
    {
        $deleted = $this->repository->delete($formulaire_field->id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @param  Request $request
     * @param  Formulaire  $formulaire
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request, Formulaire $formulaire)
    {
        if ($request->sort) {
            $formulaires_fields = FormulaireField::where('formulaire_id', $formulaire->id)->orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $formulaires_fields = FormulaireField::where('formulaire_id', $formulaire->id);
        }
        return Datatables::of($formulaires_fields)
            ->addColumn('record_id', function($formulaire_field) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="' . $formulaire_field->id . '" />
                        </div>';
            })
            ->editColumn('active', function($formulaire_field) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                return ($formulaire_field->active == 'Y' ? $label_on : $label_off);
            })
            ->addColumn('active_display', function($formulaire_field) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $formulaire_field->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $formulaire_field->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.formulaires_fields_active', ['formulaire_field' => $formulaire_field->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn btn-sm min-w-100px ' . $class_btn . '"><i class="la ' . $class_i . '"></i>' . ($formulaire_field->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($formulaire_field) {
                return '<div class="min-w-80px">
                            <a href="' . $formulaire_field->url_backend->edit . '" class="btn btn-sm btn-icon btn-light-primary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <span class="svg-icon svg-icon-2">
                                    ' . purifySvg(svg('icons/Communication/Write')) . '
                                </span>
                            </a>
                            <form action="' . $formulaire_field->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                                ' . method_field("DELETE") . '
                                ' . csrf_field() . '
                                <button class="btn btn-sm btn-icon btn-light-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <span class="svg-icon svg-icon-2">
                                        ' . purifySvg(svg('icons/General/Trash')) . '
                                    </span>
                                </button>
                            </form>
                        </div>';
            })
            ->escapeColumns(['code', 'type', 'label_front'])
            ->make(true);
    }
}
