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
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        return Datatables::of(Formulaire::all())
            ->editColumn('active', function($formulaire) {
                return $formulaire->active == 'Y' ? '<a href="#" class="btn m-btn btn-success m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-on"></i> &nbsp; Actif</a>' : '<a href="#" class="btn m-btn btn-danger m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-off"></i> &nbsp; Inactif</a>';
            })
            ->addColumn('actions', function($formulaire) {
                return '
                    <a href="' . $formulaire->url_backend->edit . '" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $formulaire->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                    </form>
                ';
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
