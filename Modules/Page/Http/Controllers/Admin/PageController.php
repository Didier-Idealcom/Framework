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
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.pages.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
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
     * Preview the specified resource.
     * @param  Page $page
     * @param  Request $request
     * @return Response
     */
    public function preview(Page $page, Request $request)
    {
        $page_blocks = json_decode($request->getContent(), true);
        if (array_is_list($page_blocks)) {
            return view('page::admin.show', compact('page', 'page_blocks'));
        }
        return view('page_blocks.' . $page_blocks['_name'], $page_blocks);
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
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        if ($request->sort) {
            $pages = Page::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $pages = Page::all();
        }
        return DataTables::of($pages)
            ->addColumn('record_id', function($page) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="' . $page->id . '" />
                        </div>';
            })
            ->editColumn('created_at', function($page) {
                return date('d/m/Y', strtotime($page->created_at));
            })
            ->editColumn('updated_at', function($page) {
                if (!empty($page->updated_at)) {
                    return date('d/m/Y', strtotime($page->updated_at));
                }
                return '';
            })
            ->editColumn('active', function($page) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                return ($page->active == 'Y' ? $label_on : $label_off);
            })
            ->addColumn('active_display', function($page) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $page->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $page->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.pages_active', ['page' => $page->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn btn-sm min-w-100px ' . $class_btn . '"><i class="la ' . $class_i . '"></i>' . ($page->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($page) {
                $items = [];
                $items['edit'] = ['link' => $page->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $page->url_backend->destroy, 'label' => 'Delete'];
                $items['preview'] = ['link' => $page->url_backend->show, 'label' => 'Preview'];
                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
