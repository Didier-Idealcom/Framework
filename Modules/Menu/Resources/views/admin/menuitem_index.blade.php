@extends('layouts.master')

@section('title_page', 'Gestion des items du menu')

@section('breadcrumb')
    @php
        $items = [];
        $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
        $items[] = ['link' => route('admin.menus.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Menus'];
        $items[] = ['link' => $menu->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => $menu->title];
        $items[] = ['link' => route('admin.menuitems.index', $menu->id), 'class' => 'text-dark', 'label' => 'Menuitems'];
    @endphp
    <x-breadcrumb :items="$items" />
@endsection

@section('subheader_toolbar')
    <x-addbutton url="{{ route('admin.menuitems.create', $menu->id) }}" />
@endsection

@section('content_page')
    @php
        $items = [];
        $items[] = ['link' => $menu->url_backend->edit, 'label' => 'Fiche détail', 'active' => false];
        $items[] = ['link' => 'javascript:;', 'label' => 'Menuitems', 'active' => true];
    @endphp
    <x-tabs :items="$items" />

    @php
        //$id = 'kt_table_menuitems';
        //$search = true;
        //$filter = true;
        //$import = 'javascript:;';
        //$export = 'javascript:;';
    @endphp
    {{-- <x-datatable :id="$id" :search="$search" :filter="$filter" :import="$import" :export="$export" /> --}}

    @if (!empty($menuitems))
    @php($count = count($menuitems))
    <div class="dd nestable">
        <ol class="dd-list">
            @foreach ($menuitems as $key => $menuitem)
            @php($next = $menuitems->get($key+1))
            <li class="dd-item" data-id="{{ $menuitem->id }}">
                <div class="dd-handle">{{ $menuitem->title_menu }}</div>
                @if (($menuitem->bd - $menuitem->bg) > 1 && $next && $next->niveau > $menuitem->niveau)
                <ol class="dd-list">
                @else
            </li>
                @endif

                @php($diff = $next ? $menuitem->niveau - $next->niveau : $menuitem->niveau - 1)
                @if ($diff > 0 && $key < $count)
                @for ($i = 0; $i < $diff; $i++)
                    </ol>
                </li>
                @endfor
                @endif
            @endforeach
        </ol>
    </div>
    @endif
@endsection

@push('scripts')
    <!--begin::Page Snippets -->
    <script type="text/javascript">
        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            /*var target = '#kt_table_menuitems';
            var url = '{!! route('admin.menuitems_datatable', $menu->id) !!}';
            var columns = [{
                data: 'record_id',
                name: 'record_id',
                title: '#',
                width: 30,
                textAlign: 'center'
            }, {
                data: 'id',
                name: 'id',
                title: 'ID',
                width: 50,
                visible: false,
                textAlign: 'center'
            }, {
                data: 'bg',
                name: 'bg',
                title: 'BG',
                width: 50
            }, {
                data: 'bd',
                name: 'bd',
                title: 'BD',
                width: 50
            }, {
                data: 'title_menu',
                name: 'title_menu',
                title: 'Titre menu'
            }, {
                data: 'active',
                name: 'active',
                title: 'Statut',
                width: 100,
                orderable: false,
                customFilter: true,
                customFilterSmart: false,
                render: function(data, type, row) {
                    if (type === 'display') {
                        return row.active_display;
                    }
                    return data;
                }
            }, {
                data: 'actions',
                name: 'actions',
                title: 'Actions',
                width: 125,
                orderable: false,
                searchable: false
            }];

            MyListDatatable.init(target, url, columns);*/

            $('.nestable').nestable({
                callback: function() {
                    console.log(JSON.stringify($('.nestable').nestable('toArray')));
                }
            });
        });
    </script>
    <!--end::Page Snippets -->
@endpush
