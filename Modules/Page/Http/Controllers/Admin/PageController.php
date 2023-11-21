<?php

namespace Modules\Page\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Core\Repositories\RepositoryInterface;
use Modules\Page\Entities\Page;
use Modules\Page\Forms\PageForm;
use Yajra\Datatables\Datatables;

class PageController extends Controller
{
    /**
     * PageController constructor.
     */
    public function __construct(Page $page, private FormBuilder $formBuilder, protected RepositoryInterface $repository)
    {
        $this->middleware('auth:admin');

        $this->repository->setModel($page);
    }

    /**
     * Return the formBuilder
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(Page $page = null)
    {
        $page = $page ?: new Page();

        return $this->formBuilder->create(PageForm::class, [
            'model' => $page,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('page::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();

        return view('page::admin.form', compact('form'));
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
     *
     * @return Response
     */
    public function show(Page $page)
    {
        return view('page::admin.show', compact('page'));
    }

    /**
     * Preview the specified resource.
     *
     * @return Response
     */
    public function preview(Page $page, Request $request)
    {
        $page_blocks = json_decode($request->getContent(), true);
        if (array_is_list($page_blocks)) {
            return view('page::admin.show', compact('page', 'page_blocks'));
        }

        return view('page_blocks.'.$page_blocks['_name'], $page_blocks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Page $page)
    {
        $form = $this->getForm($page);

        return view('page::admin.form', compact('form', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
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
     * Duplicate the specified resource in storage.
     */
    public function duplicate(Page $page)
    {
        $new_page = $page->replicateWithTranslations();
        foreach ($new_page->translations as $translation) {
            $translation->title .= ' (copy)';
        }
        $new_page->active = 'N';
        $new_page->created_at = Carbon::now();
        $new_page->updated_at = Carbon::now();
        $new_page->save();

        return redirect()->route('admin.pages.index');
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     */
    public function active(Page $page)
    {
        $activated = $this->repository->switch($page->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Page $page)
    {
        $deleted = $this->repository->delete($page->id);

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
            $pages = Page::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $pages = Page::all();
        }

        return DataTables::of($pages)
            ->addColumn('record_id', function ($page) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="'.$page->id.'" />
                        </div>';
            })
            ->editColumn('created_at', function ($page) {
                return date('d/m/Y', strtotime($page->created_at));
            })
            ->editColumn('updated_at', function ($page) {
                if (! empty($page->updated_at)) {
                    return date('d/m/Y', strtotime($page->updated_at));
                }

                return '';
            })
            ->editColumn('active', function ($page) {
                $label_on = 'Actif';
                $label_off = 'Inactif';

                return $page->active == 'Y' ? $label_on : $label_off;
            })
            ->addColumn('active_display', function ($page) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $page->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $page->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';

                return '<a href="javascript:;" data-url="'.route('admin.pages_active', ['page' => $page->id]).'" data-label-on="'.$label_on.'" data-label-off="'.$label_off.'" class="toggle-active btn btn-sm min-w-100px '.$class_btn.'"><i class="la '.$class_i.'"></i>'.($page->active == 'Y' ? $label_on : $label_off).'</a>';
            })
            ->addColumn('actions', function ($page) {
                $items = [];
                $items['edit'] = ['link' => $page->url_backend->edit, 'label' => 'Edit'];
                $items['duplicate'] = ['link' => route('admin.pages_duplicate', ['page' => $page->id]), 'label' => 'Duplicate'];
                $items['delete'] = ['link' => $page->url_backend->destroy, 'label' => 'Delete'];
                $items['more'][] = ['link' => $page->url_backend->show, 'label' => 'Preview'];
                $items = apply_filters('pages_datatableactions', $items);

                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
