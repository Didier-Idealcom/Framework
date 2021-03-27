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
use Modules\Core\Repositories\ModelRepository;

class MenuitemController extends Controller
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
     * MenuitemController constructor.
     * @param Menuitem $menuitem
     * @param FormBuilder $formBuilder
     */
    public function __construct(Menuitem $menuitem, FormBuilder $formBuilder, Request $request)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->request = $request;
        $this->repository = new ModelRepository($menuitem);
    }

    /**
     * Return the formBuilder
     * @param  Menuitem|null $menuitem
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
     * @param  Menu $menu
     * @return Response
     */
    public function index(Menu $menu)
    {
        return view('menu::admin.menuitem_index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  Menu $menu
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
        return redirect()->route('admin.menuitems.index', $menuitem->menu_id);
    }

    /**
     * Show the specified resource.
     * @param  Menuitem $menuitem
     * @return Response
     */
    public function show(Menuitem $menuitem)
    {
        return view('menu::admin.menuitem_show', compact('menuitem'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Menuitem $menuitem
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
     * @param  Menuitem $menuitem
     * @return Response
     */
    public function update(Request $request, Menuitem $menuitem)
    {
        $form = $this->getForm($menuitem);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($menuitem->id, $request->all());

        Session::flash('success', 'Le menuitem a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.menuitems.create', $request->get('menu_id'));
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.menuitems.index', $request->get('menu_id'));
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     * @param Menuitem $menuitem
     */
    public function active(Menuitem $menuitem)
    {
        $activated = $this->repository->switch($menuitem->id);
    }

    /**
     * Remove the specified resource from storage.
     * @param  Menuitem $menuitem
     * @return Response
     */
    public function destroy(Menuitem $menuitem)
    {
        $deleted = $this->repository->delete($menuitem->id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @param  Menu $menu
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Menu $menu)
    {
        return Datatables::of(Menuitem::all()->where('menu_id', $menu->id))
            ->editColumn('active', function($menuitem) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $menuitem->active == 'Y' ? 'btn-success' : 'btn-danger';
                $class_i = $menuitem->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.menuitems_active', ['menuitem' => $menuitem->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn m-btn ' . $class_btn . ' m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la ' . $class_i . '"></i> &nbsp; ' . ($menuitem->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($menuitem) {
                return '
                    <a href="' . $menuitem->url_backend->edit . '" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit">
                        <span class="svg-icon svg-icon-md">
                            ' . svg('icons/Communication/Write')->toHtml() . '
                        </span>
                    </a>
                    <form action="' . $menuitem->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                            <span class="svg-icon svg-icon-md">
                                ' . svg('icons/General/Trash')->toHtml() . '
                            </span>
                        </button>
                    </form>
                ';
            })
            ->escapeColumns(['code', 'type', 'label_front'])
            ->make(true);
    }
}
