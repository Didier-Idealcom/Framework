<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\Menuitem;
use Modules\Menu\Forms\MenuitemForm;
use Modules\Core\Repositories\CoreRepository;

class MenuitemController extends Controller
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
     * MenuitemController constructor.
     * @param Menuitem $menuitem
     * @param FormBuilder $formBuilder
     */
    public function __construct(Menuitem $menuitem, FormBuilder $formBuilder, Request $request)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->request = $request;
        $this->repository = new CoreRepository($menuitem);
    }

    /**
     * Return the formBuilder
     * @param Menuitem|null $menuitem
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?Menuitem $menuitem = null)
    {
        $menuitem = $menuitem ?: new Menuitem();
        return $this->formBuilder->create(MenuitemForm::class, [
            'model' => $menuitem
        ]);
    }

    /**
     * Display a listing of the resource.
     * @param Menu $menu
     * @return Response
     */
    public function index(Menu $menu)
    {
        return view('menu::admin.menuitem_index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Menu $menu
     * @return Response
     */
    public function create(Menu $menu)
    {
        $form = $this->getForm();
        return view('menu::admin.menuitem_form', compact('form', 'menu'));
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
        $menuitem = $this->repository->create($request->all());
        Session::flash('success', 'Le menuitem a été créé avec succès');
        return redirect()->route('admin.menuitems.index');
    }

    /**
     * Show the specified resource.
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $menuitem = $this->repository->find($id);
        return view('menu::admin.menuitem_show', compact('menuitem'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Menuitem $menuitem
     * @return Response
     */
    public function edit(Menuitem $menuitem)
    {
        $form = $this->getForm($menuitem);
        $menu = $menuitem->menu;
        return view('menu::admin.menuitem_form', compact('form', 'menu', 'menuitem'));
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

        Session::flash('success', 'Le menuitem a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.menuitems.create', $request->get('menu_id'));
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.menuitems.index', $request->get('menu_id'));
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
     * @param Menu $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Menu $menu)
    {
        return Datatables::of(Menuitem::all()->where('menu_id', $menu->id))
            ->editColumn('active', function($menuitem) {
                return $menuitem->active == 'Y' ? '<a href="#" class="btn m-btn btn-success m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-on"></i> &nbsp; Actif</a>' : '<a href="#" class="btn m-btn btn-danger m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-off"></i> &nbsp; Inactif</a>';
            })
            ->addColumn('actions', function($menuitem) {
                return '
                    <a href="' . $menuitem->url_backend->edit . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $menuitem->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></button>
                    </form>
                ';
            })
            ->escapeColumns(['code', 'type', 'label_front'])
            ->make(true);
    }
}
