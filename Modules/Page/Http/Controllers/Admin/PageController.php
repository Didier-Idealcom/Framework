<?php

namespace Modules\Page\Http\Controllers\Admin;

use \App;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Page\Entities\Page;
use Modules\Page\Forms\PageForm;
use Modules\Core\Repositories\CoreRepository;

class PageController extends Controller
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
     * PageController constructor.
     * @param Page $page
     * @param FormBuilder $formBuilder
     */
    public function __construct(Page $page, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new CoreRepository($page);
    }

    /**
     * Return the formBuilder
     * @param Page|null $page
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?Page $page = null)
    {
        $page = $page ?: new Page();
        return $this->formBuilder->create(PageForm::class, [
            'model' => $page
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('page::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('page::admin.form', compact('form'));
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
        $page = $this->repository->create($request->all());
        Session::flash('success', 'La page a été créée avec succès');
        return redirect()->route('admin.pages.index');
    }

    /**
     * Show the specified resource.
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $page = $this->repository->find($id);
        return view('page::admin.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Page $page
     * @return Response
     */
    public function edit(Page $page)
    {
        $form = $this->getForm($page);
        return view('page::admin.form', compact('form'));
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

        Session::flash('success', 'La page a été enregistrée avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.pages.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.pages.index');
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
        return Datatables::of(Page::all())
            ->editColumn('active', function($page) {
                return $page->active == 'Y' ? '<a href="#" class="btn m-btn btn-success m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-on"></i> &nbsp; Actif</a>' : '<a href="#" class="btn m-btn btn-danger m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-off"></i> &nbsp; Inactif</a>';
            })
            ->addColumn('actions', function($page) {
                return '
                    <a href="' . $page->url_backend->edit . '" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $page->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
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
