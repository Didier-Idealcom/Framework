@extends('layouts.master')

@section('title_page', 'Gestion des langues du domaine')

@section('breadcrumb')
    @php
        $items = [];
        $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
        $items[] = ['link' => route('admin.domains.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Domaines'];
        $items[] = ['link' => $domain->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => $domain->title];
        $items[] = ['link' => route('admin.domains_languages.index', $domain->id), 'class' => 'text-dark', 'label' => 'Langues'];
    @endphp
    <x-breadcrumb :items="$items" />
@endsection

@section('subheader_toolbar')
    <x-addbutton url="{{ route('admin.domains_languages.create', $domain->id) }}" />
@endsection

@section('content_page')
    @php
        $items = [];
        $items[] = ['link' => $domain->url_backend->edit, 'label' => 'Fiche détail', 'active' => false];
        $items[] = ['link' => 'javascript:;', 'label' => 'Langues', 'active' => true];
    @endphp
    <x-tabs :items="$items" />

    @php
        $id = 'kt_table_domains_languages';
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
            var target = '#kt_table_domains_languages';
            var url = '{!! route('admin.domains_languages_datatable', $domain->id) !!}';
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
                data: 'language',
                name: 'language',
                title: 'Langue'
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
