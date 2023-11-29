<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\Menuitem;
use Modules\Menu\Forms\MenuForm;
use Modules\Menu\Repositories\MenuRepository;
use Yajra\Datatables\Datatables;

class MenuController extends Controller
{
    /**
     * MenuController constructor.
     */
    public function __construct(Menu $menu, private FormBuilder $formBuilder, private MenuRepository $repository)
    {
        $this->middleware('auth:admin');

        $this->repository->setModel($menu);
    }

    /**
     * Return the formBuilder
     */
    private function getForm(Menu $menu = null): MenuForm
    {
        $menu = $menu ? $menu : new Menu();

        return $this->formBuilder->create(MenuForm::class, [
            'model' => $menu,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('menu::admin.menu_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = $this->getForm();

        return view('menu::admin.menu_form', compact('form'));
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

        $this->repository->create($request->all());

        Session::flash('success', 'Le menu a été créé avec succès');

        $redirectOptions = [
            'save_close' => route('admin.menus.index'),
            'save_new' => route('admin.menus.create'),
            'save_stay' => url()->previous(),
        ];

        return redirect()->to($redirectOptions[$request->get('save')]);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show(Menu $menu)
    {
        return view('menu::admin.menu_show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit(Menu $menu)
    {
        $form = $this->getForm($menu);
        $menuitems = Menuitem::where('menu_id', $menu->id)->orderBy('bg', 'asc')->get();

        return view('menu::admin.menu_form', compact('form', 'menu', 'menuitems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update(Request $request, Menu $menu)
    {
        $form = $this->getForm($menu);
        $form->redirectIfNotValid();

        $this->repository->update($menu->id, $request->all());

        Session::flash('success', 'Le menu a été enregistré avec succès');

        $redirectOptions = [
            'save_close' => route('admin.menus.index'),
            'save_new' => route('admin.menus.create'),
            'save_stay' => url()->previous(),
        ];

        return redirect()->to($redirectOptions[$request->get('save')]);
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     */
    public function active(Menu $menu)
    {
        $this->repository->switch($menu->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Menu $menu)
    {
        $this->repository->delete($menu->id);

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
            $menus = Menu::orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $menus = Menu::all();
        }

        return DataTables::of($menus)
            ->addColumn('record_id', function ($menu) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="'.$menu->id.'" />
                        </div>';
            })
            ->editColumn('active', function ($menu) {
                $label_on = 'Actif';
                $label_off = 'Inactif';

                return $menu->active === 'Y' ? $label_on : $label_off;
            })
            ->addColumn('active_display', function ($menu) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $menu->active === 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $menu->active === 'Y' ? 'la-toggle-on' : 'la-toggle-off';

                return '<a href="javascript:;" data-url="'.route('admin.menus_active', ['menu' => $menu->id]).'" data-label-on="'.$label_on.'" data-label-off="'.$label_off.'" class="toggle-active btn btn-sm min-w-100px '.$class_btn.'"><i class="la '.$class_i.'"></i>'.($menu->active === 'Y' ? $label_on : $label_off).'</a>';
            })
            ->addColumn('actions', function ($menu) {
                $items = [];
                $items['edit'] = ['link' => $menu->url_backend->edit, 'label' => 'Edit'];
                $items['delete'] = ['link' => $menu->url_backend->destroy, 'label' => 'Delete'];
                $items['more'][] = ['link' => route('admin.menuitems.index', $menu->id), 'label' => 'Menuitems'];
                $items = apply_filters('menus_datatableactions', $items);

                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
