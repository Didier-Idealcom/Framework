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
use Modules\Core\Repositories\ModelRepository;

class MenuController extends Controller
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
     * MenuController constructor.
     * @param Menu $menu
     * @param FormBuilder $formBuilder
     */
    public function __construct(Menu $menu, FormBuilder $formBuilder)
    {
        $this->middleware('auth:admin');

        $this->formBuilder = $formBuilder;
        $this->repository = new ModelRepository($menu);
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
     * Activate/Deactivate the specified resource in storage.
     * @param Menu $menu
     */
    public function active(Menu $menu)
    {
        $activated = $this->repository->switch($menu->id);
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
            /*->editColumn('active', function($menu) {
                return $menu->active == 'Y' ? '<a href="#" class="btn m-btn btn-success m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-on"></i> &nbsp; Actif</a>' : '<a href="#" class="btn m-btn btn-danger m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la la-toggle-off"></i> &nbsp; Inactif</a>';
            })*/
            ->editColumn('active', function($menu) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $menu->active == 'Y' ? 'btn-success' : 'btn-danger';
                $class_i = $menu->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.menus_active', ['menu' => $menu->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn m-btn ' . $class_btn . ' m-btn--icon m-btn--pill m-btn--wide btn-sm"><i class="la ' . $class_i . '"></i> &nbsp; ' . ($menu->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($menu) {
                return '
                    <a href="' . $menu->url_backend->edit . '" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Edit">
                        <span class="svg-icon svg-icon-md">
                            ' . svg(theme_url('media/svg/icons/Communication/') . 'Write') . '
                        </span>
                    </a>
                    <form action="' . $menu->url_backend->destroy . '" method="POST" class="form-delete d-inline-block mr-2">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                        <button class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Delete">
                            <span class="svg-icon svg-icon-md">
                                ' . svg(theme_url('media/svg/icons/General/') . 'Trash') . '
                            </span>
                        </button>
                    </form>
                    <div class="dropdown dropdown-inline">
                        <a href="javascript:;" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" data-toggle="dropdown">
                            <span class="svg-icon svg-icon-md">
                                ' . preg_replace('#<title>.*</title>#', '', svg_image(theme_url('media/svg/icons/General/') . 'Other2')->renderInline()) . '
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <a class="navi-link" href="' . route('admin.menuitems.index', $menu->id) . '">
                                        <span class="navi-icon"><i class="la la-edit"></i></span>
                                        <span class="navi-text">Menuitems</span>
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
