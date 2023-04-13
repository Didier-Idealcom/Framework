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
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.menus.create');
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }
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
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        if ($request->sort) {
            $menus = Menu::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $menus = Menu::all();
        }
        return DataTables::of($menus)
            ->addColumn('record_id', function($menu) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="' . $menu->id . '" />
                        </div>';
            })
            ->editColumn('active', function($menu) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                return ($menu->active == 'Y' ? $label_on : $label_off);
            })
            ->addColumn('active_display', function($menu) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $menu->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $menu->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                return '<a href="javascript:;" data-url="' . route('admin.menus_active', ['menu' => $menu->id]) . '" data-label-on="' . $label_on . '" data-label-off="' . $label_off . '" class="toggle-active btn btn-sm min-w-100px ' . $class_btn . '"><i class="la ' . $class_i . '"></i>' . ($menu->active == 'Y' ? $label_on : $label_off) . '</a>';
            })
            ->addColumn('actions', function($menu) {
                $items = [];
                $items['edit'] = ['link' => $menu->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $menu->url_backend->destroy, 'label' => 'Delete'];
                $items['more'] = ['link' => route('admin.menuitems.index', $menu->id), 'label' => 'Menuitems'];
                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
