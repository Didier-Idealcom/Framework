@extends('layouts.master')

@if (isset($domain))
    @section('title_page', 'Gestion des domaines : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.domains.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Domaines'];
            $items[] = ['link' => $domain->url_backend->edit, 'class' => 'text-dark', 'label' => $domain->title];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des domaines : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.domains.index'), 'class' => 'text-dark', 'label' => 'Domaines'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.domains.index') }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    @if (isset($domain))
        @php
            $items = [];
            $items[] = ['link' => 'javascript:;', 'label' => 'Fiche détail', 'active' => true];
            $items[] = ['link' => route('admin.domains_languages.index', $domain->id), 'label' => 'Langues', 'active' => false];
        @endphp
        {{-- <x-tabs :items="$items" /> --}}
    @endif

    <x-form :form="$form" />

    @if (isset($domain))
        @php
            $id = 'kt_table_domains_languages';
            $search = false;
            $filter = false;
            $import = '';
            $export = '';
        @endphp
        <x-datatable :id="$id" :search="$search" :filter="$filter" :import="$import" :export="$export" />

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
                        data: 'row_details',
                        name: 'row_details',
                        width: 50,
                        orderable: false,
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return row.row_details_display;
                            }
                            return data;
                        }
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
                        data: 'default',
                        name: 'default',
                        title: 'Défaut',
                        width: 100,
                        orderable: false,
                        customFilter: true,
                        customFilterSmart: false,
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return row.default_display;
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
    @endif
@endsection
