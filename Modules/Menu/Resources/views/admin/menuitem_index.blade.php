@extends('layouts.master')

@section('title_page', 'Gestion des menus')

@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
               <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="javascript:;" class="m-nav__link">
                <span class="m-nav__link-text">Configuration</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.menus.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Menus</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.menuitems.index', $menu->id) }}" class="m-nav__link">
                <span class="m-nav__link-text">Menuitems</span>
            </a>
        </li>
    </ul>
@stop

@section('content_page')
    <div class="alert alert-brand alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>INFO</strong> : This view is loaded from module: {!! config('framework.menu.config.name') !!}
    </div>

    <!-- begin: Portlet -->
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon">
                        <i class="flaticon-signs-1"></i>
                    </span>
                    <h3 class="m-portlet__head-text">Liste des menuitems</h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{{ route('admin.menuitems.create', $menu->id) }}" class="m-portlet__nav-link btn btn-success m-btn m-btn--pill">
                            <i class="la la-plus"></i> Ajouter
                        </a>
                    </li>
                    <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                        <a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn-brand m-btn m-btn--pill">
                            <i class="la la-gear"></i> Outils
                        </a>
                        <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content">
                                        <ul class="m-nav">
                                            <li class="m-nav__section m-nav__section--first">
                                                <span class="m-nav__section-text">Quick Actions</span>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-up-arrow"></i>
                                                    <span class="m-nav__link-text">Importer</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-download"></i>
                                                    <span class="m-nav__link-text">Exporter</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            @include('partials.flash')

            <!--begin: Datatable -->
            <div class="m_datatable" id="menuitems_datatable"></div>
            <!--end: Datatable -->
        </div>
    </div>
    <!-- end: Portlet -->
@stop

@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var datatable = $('#menuitems_datatable').mDatatable({
                // datasource definition
                data: {
                    type: 'remote',
                    source: {
                        read: {
                            url: '{!! route('admin.menuitems_datatable', $menu->id) !!}',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            map: function(raw) {
                                // sample data mapping
                                var dataSet = raw;
                                if (typeof raw.data !== 'undefined') {
                                    dataSet = raw.data;
                                }
                                return dataSet;
                            }
                        }
                    },
                    pageSize: 10,
                    serverPaging: true,
                    serverFiltering: true,
                    serverSorting: true
                },

                // layout definition
                layout: {
                    scroll: false,
                    footer: false
                },

                // column sorting
                sortable: true,

                pagination: true,

                toolbar: {
                    // toolbar position
                    placement: ['top', 'bottom'],

                    // toolbar items
                    items: {
                        // pagination
                        pagination: {
                            // page size select
                            pageSizeSelect: [10, 20, 30, 50, 100],
                        }
                    }
                },

                // columns definition
                columns: [{
                    field: 'RecordID',
                    title: '#',
                    sortable: false,
                    width: 30,
                    textAlign: 'center',
                    selector: {class: 'm-checkbox--solid m-checkbox--brand'}
                }, {
                    field: 'id',
                    title: 'ID',
                    width: 50,
                    textAlign: 'center'
                }, {
                    field: 'active',
                    title: 'Statut'
                }, {
                    field: 'title_menu',
                    title: 'Titre menu'
                }, {
                    field: 'actions',
                    title: 'Actions',
                    width: 100,
                    sortable: false
                }],

                // extentions
                extensions: {
                    checkbox: {}
                }
            });
        });
    </script>
@endpush
