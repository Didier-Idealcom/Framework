<?php

namespace Modules\Formulaire\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Formulaire\Entities\Formulaire;
use Modules\Formulaire\Entities\FormulaireField;
use Modules\Formulaire\Forms\FormulaireFieldForm;
use Modules\Core\Repositories\CoreRepository;

class FormulaireFieldController extends Controller
{
    /**
     * @var FormBuilder
     */
    private $formBuilder;

    /**
     * @var CoreRepository
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
        $this->repository = new CoreRepository($formulaire_field);
    }

    /**
     * Return the formBuilder
     * @param FormulaireField|null $formulaire_field
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
     * @param Formulaire $formulaire
     * @return Response
     */
    public function index(Formulaire $formulaire)
    {
        return view('formulaire::admin.formulaire_field_index', compact('formulaire'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Formulaire $formulaire
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
        return redirect()->route('admin.formulaires_fields.index');
    }

    /**
     * Show the specified resource.
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $formulaire_field = $this->repository->find($id);
        return view('formulaire::admin.formulaire_field_show', compact('formulaire_field'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param FormulaireField $formulaire_field
     * @return Response
     */
    public function edit(FormulaireField $formulaire_field)
    {
        $form = $this->getForm($formulaire_field);
        return view('formulaire::admin.formulaire_field_form', compact('form', 'formulaire_field'));
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
        $updated = $this->repository->update($id, $request->all());

        Session::flash('success', 'Le champ de formulaire a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.formulaires_fields.create', $request->get('formulaire_id'));
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.formulaires_fields.index', $request->get('formulaire_id'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @param Formulaire $formulaire
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Formulaire $formulaire)
    {
        return Datatables::of(FormulaireField::all()->where('formulaire_id', $formulaire->id))
            ->editColumn('active', function($formulaire_field) {
                return $formulaire_field->active == 'Y' ? '<a href="#" class="btn m-btn btn-success m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-on"></i> &nbsp; Actif</a>' : '<a href="#" class="btn m-btn btn-danger m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-off"></i> &nbsp; Inactif</a>';
            })
            ->addColumn('actions', function($formulaire_field) {
                return '
                    <a href="' . $formulaire_field->url_backend->edit . '" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $formulaire_field->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                    </form>
                ';
            })
            ->escapeColumns(['code', 'type', 'label_front'])
            ->make(true);
    }
}
