<?php

namespace Modules\Formulaire\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Formulaire\Entities\Formulaire;
use Modules\Formulaire\Forms\FormulaireForm;
use Modules\Formulaire\Forms\FormulairePreviewForm;
use Modules\Core\Repositories\ModelRepository;

class FormulaireController extends Controller
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
     * FormulaireController constructor.
     * @param Formulaire $formulaire
     * @param FormBuilder $formBuilder
     */
    public function __construct(Formulaire $formulaire, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new ModelRepository($formulaire);
    }

    /**
     * Return the formBuilder
     * @param  Formulaire|null $formulaire
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?Formulaire $formulaire = null)
    {
        $formulaire = $formulaire ?: new Formulaire();
        return $this->formBuilder->create(FormulaireForm::class, [
            'model' => $formulaire
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('formulaire::admin.formulaire_index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('formulaire::admin.formulaire_form', compact('form'));
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
     * @param  Formulaire $formulaire
     * @return Response
     */
    public function show(Formulaire $formulaire)
    {
        $form = $this->formBuilder->create(FormulairePreviewForm::class, [
            'model' => $formulaire
        ]);
        return view('formulaire::admin.formulaire_show', compact('formulaire', 'form'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Formulaire $formulaire
     * @return Response
     */
    public function edit(Formulaire $formulaire)
    {
        $form = $this->getForm($formulaire);
        return view('formulaire::admin.formulaire_form', compact('form', 'formulaire'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Formulaire $formulaire
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
     * @param Formulaire $formulaire
     */
    public function active(Formulaire $formulaire)
    {
        $activated = $this->repository->switch($formulaire->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Formulaire $formulaire
     * @return Response
     */
    public function destroy(Formulaire $formulaire)
    {
        $deleted = $this->repository->delete($formulaire->id);
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
            $formualires = Formulaire::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $formualires = Formulaire::all();
        }
        return DataTables::of($formualires)
            ->addColumn('record_id', function($formulaire) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="' . $formulaire->id . '" />
                        </div>';
            })
            ->editColumn('active', function($formulaire) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                return ($formulaire->active == 'Y' ? $label_on : $label_off);
            })
            ->addColumn('active_display', function($formulaire) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $formulaire->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $formulaire->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.formulaires_active', ['formulaire' => $formulaire->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn btn-sm min-w-100px ' . $class_btn . '"><i class="la ' . $class_i . '"></i>' . ($formulaire->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($formulaire) {
                return '<div class="min-w-175px">
                            <a href="' . $formulaire->url_backend->edit . '" class="btn btn-sm btn-icon btn-light-primary me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <span class="svg-icon svg-icon-2">
                                    ' . purifySvg(svg('icons/Communication/Write')) . '
                                </span>
                            </a>
                            <form action="' . $formulaire->url_backend->destroy . '" method="POST" class="form-delete d-inline-block me-2">
                                ' . method_field("DELETE") . '
                                ' . csrf_field() . '
                                <button class="btn btn-sm btn-icon btn-light-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <span class="svg-icon svg-icon-2">
                                        ' . purifySvg(svg('icons/General/Trash')) . '
                                    </span>
                                </button>
                            </form>
                            <a href="' . route('admin.formulaires_fields.index', $formulaire->id) . '" class="btn btn-sm btn-icon btn-light-dark me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Champs">
                                <span class="svg-icon svg-icon-2">
                                    ' . purifySvg(svg('icons/General/Other2')) . '
                                </span>
                            </a>
                            <a href="' . $formulaire->url_backend->show . '" class="btn btn-sm btn-icon btn-light-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Preview">
                                <span class="svg-icon svg-icon-2">
                                    ' . purifySvg(svg('icons/General/Visible')) . '
                                </span>
                            </a>
                        </div>';
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
