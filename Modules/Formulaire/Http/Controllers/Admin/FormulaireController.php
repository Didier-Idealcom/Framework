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
use Modules\Core\Repositories\CoreRepository;

class FormulaireController extends Controller
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
     * FormulaireController constructor.
     * @param Formulaire $formulaire
     * @param FormBuilder $formBuilder
     */
    public function __construct(Formulaire $formulaire, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new CoreRepository($formulaire);
    }

    /**
     * Return the formBuilder
     * @param Formulaire|null $formulaire
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
        return redirect()->route('admin.formulaires.index');
    }

    /**
     * Show the specified resource.
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $formulaire = $this->repository->find($id);
        return view('formulaire::admin.formulaire_show', compact('formulaire'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Formulaire $formulaire
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
     * @param  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $form = $this->getForm();
        $form->redirectIfNotValid();
        $updated = $this->repository->update($id, $request->all());

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
     * @param  $id
     */
    public function active($id)
    {
        $activated = $this->repository->active($id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  $id
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        return Datatables::of(Formulaire::all())
            ->editColumn('active', function($formulaire) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $formulaire->active == 'Y' ? 'btn-success' : 'btn-danger';
                $class_i = $formulaire->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.formulaires_active', ['id' => $formulaire->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn m-btn ' . $class_btn . ' m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la ' . $class_i . '"></i> &nbsp; ' . ($formulaire->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($formulaire) {
                return '
                    <a href="' . $formulaire->url_backend->edit . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $formulaire->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md" aria-label="Delete"><i class="la la-trash"></i></button>
                    </form>
                    <div class="dropdown">
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="' . route('admin.formulaires_fields.index', $formulaire->id) . '"><i class="la la-edit"></i> Champs</a>
                        </div>
                    </div>
                ';
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
