<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Yajra\Datatables\Datatables;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Forms\MenuForm;
use Modules\Core\Repositories\CoreRepository;

class MenuController extends Controller
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
     * MenuController constructor.
     * @param Menu $menu
     * @param FormBuilder $formBuilder
     */
    public function __construct(Menu $menu, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new CoreRepository($menu);
    }

    /**
     * Return the formBuilder
     * @param  Menu|null $menu
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(?Menu $menu = null)
    {
        $menu = $menu ?: new Menu();
        return $this->formBuilder->create(MenuForm::class, [
            'model' => $menu
        ]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('menu::admin.menu_index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();
        return view('menu::admin.menu_form', compact('form'));
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
        $menu = $this->repository->create($request->all());

        Session::flash('success', 'Le menu a été créé avec succès');
        return redirect()->route('admin.menus.index');
    }

    /**
     * Show the specified resource.
     * @param  Menu $menu
     * @return Response
     */
    public function show(Menu $menu)
    {
        return view('menu::admin.menu_show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  Menu $menu
     * @return Response
     */
    public function edit(Menu $menu)
    {
        $form = $this->getForm($menu);
        return view('menu::admin.menu_form', compact('form', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @param  Menu $menu
     * @return Response
     */
    public function update(Request $request, Menu $menu)
    {
        $form = $this->getForm($menu);
        $form->redirectIfNotValid();
        $updated = $this->repository->update($menu->id, $request->all());

        Session::flash('success', 'Le menu a été enregistré avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.menus.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
        return redirect()->route('admin.menus.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param  Menu $menu
     * @return Response
     */
    public function destroy(Menu $menu)
    {
        $deleted = $this->repository->delete($menu->id);
        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable()
    {
        return Datatables::of(Menu::all())
            ->editColumn('active', function($menu) {
                return $menu->active == 'Y' ? '<a href="#" class="btn m-btn btn-success m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-on"></i> &nbsp; Actif</a>' : '<a href="#" class="btn m-btn btn-danger m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-off"></i> &nbsp; Inactif</a>';
            })
            ->addColumn('actions', function($menu) {
                return '
                    <a href="' . $menu->url_backend->edit . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit">
                        <i class="la la-edit"></i>
                    </a>
                    <form action="' . $menu->url_backend->destroy . '" method="POST" class="form-delete d-inline-block">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-trash"></i></button>
                    </form>
                    <div class="dropdown">
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="' . route('admin.menuitems.index', $menu->id) . '"><i class="la la-edit"></i> Menuitems</a>
                        </div>
                    </div>
                ';
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
