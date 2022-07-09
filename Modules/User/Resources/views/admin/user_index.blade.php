@extends('layouts.master')

@section('title_page', 'Gestion des utilisateurs')

@section('breadcrumb')
    @php
        $items = [];
        $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
        $items[] = ['link' => route('admin.users.index'), 'class' => 'text-dark', 'label' => 'Utilisateurs'];
    @endphp
    <x-breadcrumb :items="$items" />
@endsection

@section('subheader_toolbar')
    <x-addbutton url="{{ route('admin.users.create') }}" />
@endsection

@section('content_page')
    @php
        $id = 'kt_table_users';
        $search = true;
        $filter = true;
        $import = 'javascript:;';
        $export = 'javascript:;';
    @endphp
    <x-datatable :id="$id" :search="$search" :filter="$filter" :import="$import" :export="$export" />
@endsection

@push('scripts')
    <script type="text/javascript">
        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            var target = '#kt_table_users';
            var url = '{!! route('admin.users_datatable') !!}';
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
                data: 'user',
                name: 'user',
                title: 'Utilisateur',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return row.user_display;
                    }
                    return data;
                }
            }, {
                data: 'role',
                name: 'role',
                title: 'Rôle',
                customFilter: true,
                customFilterSmart: true
            }, {
                data: 'created_at',
                name: 'created_at',
                title: 'Inscription',
                type: 'date',
                format: 'DD/MM/YYYY'
            }, {
                data: 'last_login_at',
                name: 'last_login_at',
                title: 'Dernière connexion',
                type: 'date',
                format: 'DD/MM/YYYY'
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
@endpush
