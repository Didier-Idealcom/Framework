<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Kris\LaravelFormBuilder\FormBuilder;
use Modules\Core\Repositories\RepositoryInterface;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\Menuitem;
use Modules\Menu\Forms\MenuitemForm;
use Yajra\Datatables\Datatables;

class MenuitemController extends Controller
{
    /**
     * MenuitemController constructor.
     */
    public function __construct(Menuitem $menuitem, private FormBuilder $formBuilder, protected RepositoryInterface $repository)
    {
        $this->middleware('auth:admin');

        $this->repository->setModel($menuitem);
    }

    /**
     * Return the formBuilder
     *
     * @return \Kris\LaravelFormBuilder\Form
     */
    private function getForm(Menuitem $menuitem = null)
    {
        $menuitem = $menuitem ?: new Menuitem();

        return $this->formBuilder->create(MenuitemForm::class, [
            'model' => $menuitem,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Menu $menu)
    {
        $menuitems = Menuitem::where('menu_id', $menu->id)->orderBy('bg', 'asc')->get();

        return view('menu::admin.menuitem_index', compact('menu', 'menuitems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Menu $menu)
    {
        $form = $this->getForm();

        return view('menu::admin.menuitem_form', compact('form', 'menu'));
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
        $menuitem = $this->repository->create($request->all());

        Session::flash('success', 'Le menuitem a été créé avec succès');
        if ($request->get('save') == 'save_new') {
            return redirect()->route('admin.menuitems.create', $request->get('menu_id'));
        } elseif ($request->get('save') == 'save_stay') {
            return redirect()->back();
        }

        return redirect()->route('admin.menuitems.index', $menuitem->menu_id);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show(Menuitem $menuitem)
    {
        return view('menu::admin.menuitem_show', compact('menuitem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
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
     *
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
     * Duplicate the specified resource in storage.
     */
    public function duplicate(Menuitem $menuitem)
    {
        $new_menuitem = $menuitem->replicateWithTranslations();
        foreach ($new_menuitem->translations as $translation) {
            $translation->title_menu .= ' (copy)';
            $translation->title_page .= ' (copy)';
        }
        $new_menuitem->active = 'N';
        $new_menuitem->created_at = Carbon::now();
        $new_menuitem->updated_at = Carbon::now();
        $new_menuitem->save();

        return redirect()->route('admin.menuitems.index', $menuitem->menu_id);
    }

    /**
     * Activate/Deactivate the specified resource in storage.
     */
    public function active(Menuitem $menuitem)
    {
        $activated = $this->repository->switch($menuitem->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Menuitem $menuitem)
    {
        $deleted = $this->repository->delete($menuitem->id);

        return redirect()->back();
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request, Menu $menu)
    {
        if ($request->sort) {
            $menuitems = Menuitem::where('menu_id', $menu->id)->orderBy($request->sort['field'], $request->sort['sort']);
        } else {
            $menuitems = Menuitem::where('menu_id', $menu->id)->orderBy('bg', 'asc');
        }

        return Datatables::of($menuitems)
            ->addColumn('record_id', function ($menuitem) {
                return '<div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="'.$menuitem->id.'" />
                        </div>';
            })
            ->editColumn('active', function ($menuitem) {
                $label_on = 'Actif';
                $label_off = 'Inactif';

                return $menuitem->active == 'Y' ? $label_on : $label_off;
            })
            ->addColumn('active_display', function ($menuitem) {
                $label_on = 'Actif';
                $label_off = 'Inactif';
                $class_btn = $menuitem->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                $class_i = $menuitem->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';

                return '<a href="javascript:;" data-url="'.route('admin.menuitems_active', ['menuitem' => $menuitem->id]).'" data-label-on="'.$label_on.'" data-label-off="'.$label_off.'" class="toggle-active btn btn-sm min-w-100px '.$class_btn.'"><i class="la '.$class_i.'"></i>'.($menuitem->active == 'Y' ? $label_on : $label_off).'</a>';
            })
            ->editColumn('title_menu', function ($menuitem) {
                return '<span style="margin-left: '.(($menuitem->niveau - 1) * 30).'px">'.$menuitem->title_menu.'</span>';
            })
            ->addColumn('actions', function ($menuitem) {
                $items = [];
                $items['edit'] = ['link' => $menuitem->url_backend->edit, 'label' => 'Edit'];
                $items['duplicate'] = ['link' => route('admin.menuitems_duplicate', ['menuitem' => $menuitem->id]), 'label' => 'Duplicate'];
                $items['delete'] = ['link' => $menuitem->url_backend->destroy, 'label' => 'Delete'];
                $items['more'][] = ['link' => $menuitem->url_backend->show, 'label' => 'Preview'];
                $items['more'][] = ['link' => route('admin.menuitems.create', ['menu' => $menuitem->menu_id, 'parent' => $menuitem->id]), 'label' => 'Add submenu'];
                $items = apply_filters('menuitems_datatableactions', $items);

                return view('components.datatableactions', compact('items'));
            })
            ->escapeColumns(['code', 'type', 'label_front'])
            ->make(true);
    }
}
