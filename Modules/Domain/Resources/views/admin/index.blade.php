@extends('layouts.master')

@section('title_page', 'Gestion des domaines')

@section('breadcrumb')
    @php
        $items = [];
        $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
        $items[] = ['link' => route('admin.domains.index'), 'class' => 'text-dark', 'label' => 'Domaines'];
    @endphp
    <x-breadcrumb :items="$items" />
@endsection

@section('subheader_toolbar')
    <x-addbutton url="{{ route('admin.domains.create') }}" />
@endsection

@section('content_page')
    @php
        $id = 'kt_table_domains';
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
            var target = '#kt_table_domains';
            var url = '{!! route('admin.domains_datatable') !!}';
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
                data: 'title',
                name: 'title',
                title: 'Titre'
            }, {
                data: 'name',
                name: 'name',
                title: 'Nom'
            }, {
                data: 'folder',
                name: 'folder',
                title: 'Dossier'
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
                orderable: false,
                searchable: false
            }];

            MyListDatatable.init(target, url, columns);
        });
    </script>
    <!--end::Page Snippets -->
@endpush
