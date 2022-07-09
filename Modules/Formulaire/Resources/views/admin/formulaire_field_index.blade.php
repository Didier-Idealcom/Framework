@extends('layouts.master')

@section('title_page', 'Gestion des champs de formulaire')

@section('breadcrumb')
    @php
        $items = [];
        $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
        $items[] = ['link' => route('admin.formulaires.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Formulaires'];
        $items[] = ['link' => $formulaire->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => $formulaire->title];
        $items[] = ['link' => route('admin.formulaires_fields.index', $formulaire->id), 'class' => 'text-dark', 'label' => 'Champs'];
    @endphp
    <x-breadcrumb :items="$items" />
@endsection

@section('subheader_toolbar')
    <x-addbutton url="{{ route('admin.formulaires_fields.create', $formulaire->id) }}" />
@endsection

@section('content_page')
    @php
        $items = [];
        $items[] = ['link' => $formulaire->url_backend->edit, 'label' => 'Fiche détail', 'active' => false];
        $items[] = ['link' => 'javascript:;', 'label' => 'Champs', 'active' => true];
    @endphp
    <x-tabs :items="$items" />

    @php
        $id = 'kt_table_formulaires_fields';
        $search = true;
        $filter = true;
        $import = 'javascript:;';
        $export = 'javascript:;';
    @endphp
    <x-datatable :id="$id" :search="$search" :filter="$filter" :import="$import" :export="$export" />
@endsection

@push('scripts')
    <!--begin::Page Snippets -->
    <script type="text/javascript">
        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            var target = '#kt_table_formulaires_fields';
            var url = '{!! route('admin.formulaires_fields_datatable', $formulaire->id) !!}';
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
                data: 'code',
                name: 'code',
                title: 'Code'
            }, {
                data: 'type',
                name: 'type',
                title: 'Type'
            }, {
                data: 'label_front',
                name: 'label_front',
                title: 'Label'
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
                width: 80,
                orderable: false
            }];

            MyListDatatable.init(target, url, columns);
        });
    </script>
    <!--end::Page Snippets -->
@endpush
