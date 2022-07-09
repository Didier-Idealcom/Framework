@extends('layouts.master')

@section('title_page', 'Gestion des permissions')

@section('breadcrumb')
    @php
        $items = [];
        $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
        $items[] = ['link' => route('admin.users.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Utilisateurs'];
        $items[] = ['link' => route('admin.permissions.index'), 'class' => 'text-dark', 'label' => 'Permissions'];
    @endphp
    <x-breadcrumb :items="$items" />
@endsection

@section('subheader_toolbar')
    <x-addbutton url="{{ route('admin.permissions.create') }}" />
@endsection

@section('content_page')
    @php
        $id = 'kt_table_permissions';
        $search = true;
        $filter = false;
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
            var target = '#kt_table_permissions';
            var url = '{!! route('admin.permissions_datatable') !!}';
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
                data: 'name',
                name: 'name',
                title: 'Nom'
            }, {
                data: 'assigned_to',
                name: 'assigned_to',
                title: 'Assignée à'
            }, {
                data: 'created_at',
                name: 'created_at',
                title: 'Création',
                type: 'date',
                format: 'DD/MM/YYYY'
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
