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
use Modules\Core\Repositories\ModelRepository;

class PageController extends Controller
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
     * PageController constructor.
     * @param Page $page
     * @param FormBuilder $formBuilder
     */
    public function __construct(Page $page, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new ModelRepository($page);
    }

    /**
     * Return the formBuilder
     * @param  Page|null $page
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
     * @param  Page $page
     * @return Response
     */
    public function show(Page $page)
    {
        return view('page::admin.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Page $page
     * @return Response
     */
    public function edit(Page $page)
    {
        $form = $this->getForm($page);
        return view('page::admin.form', compact('form', 'page'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Page $page
     * @return Response
     */
    public function update(Request $request, Page $page)
    {
        $form = $this->getForm($page);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($page->id, $request->all());

        Session::flash('success', 'La page a été enregistrée avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.pages.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.pages.index');
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param Page $page
     */
    public function active(Page $page)
    {
        $activated = $this->repository->switch($page->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Page $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        $deleted = $this->repository->delete($page->id);
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
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $page->active == 'Y' ? 'btn-success' : 'btn-danger';
                $class_i = $page->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.pages_active', ['page' => $page->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn m-btn ' . $class_btn . ' m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la ' . $class_i . '"></i> &nbsp; ' . ($page->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($page) {
                return '
                    <a href="' . $page->url_backend->edit . '" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit">
                        <span class="svg-icon svg-icon-md">
                            ' . svg('icons/Communication/Write')->toHtml() . '
                        </span>
                    </a>
                    <form action="' . $page->url_backend->destroy . '" method="POST" class="form-delete d-inline-block mr-2">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                            <span class="svg-icon svg-icon-md">
                                ' . svg('icons/General/Trash')->toHtml() . '
                            </span>
                        </button>
                    </form>
                    <div class="dropdown dropdown-inline">
                        <a href="javascript:;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" data-toggle="dropdown">
                            <span class="svg-icon svg-icon-md">
                                ' . svg('icons/General/Other2')->toHtml() . '
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <a class="navi-link" href="' . $page->url_backend->show . '">
                                        <span class="navi-icon"><i class="la la-eye"></i></span>
                                        <span class="navi-text">Preview</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                ';
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
