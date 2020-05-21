@extends('layouts.master')

@section('title_page', 'Gestion des domaines')

@section('breadcrumb')
    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="{{ route('admin.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <span class="kt-subheader__breadcrumbs-separator"></span>
        <a href="{{ route('admin.domains.index') }}" class="kt-subheader__breadcrumbs-link">Domaines</a>
    </div>
@stop

@section('subheader_toolbar')
    <a href="{{ route('admin.domains.create') }}" class="btn btn-label-brand btn-bold">Ajouter</a>
    <div class="kt-subheader__wrapper">
        <div class="dropdown dropdown-inline" data-toggle="kt-tooltip-" title="Quick actions" data-placement="left">
            <a href="#" class="btn btn-icon"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--success kt-svg-icon--md">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000"/>
                    </g>
                </svg>
                <!--<i class="flaticon2-plus"></i>-->
            </a>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-md dropdown-menu-right">
                <!--begin::Nav-->
                <ul class="kt-nav">
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                            <span class="kt-nav__link-text">Importer</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="#" class="kt-nav__link">
                            <i class="kt-nav__link-icon flaticon2-drop"></i>
                            <span class="kt-nav__link-text">Exporter</span>
                        </a>
                    </li>
                </ul>
                <!--end::Nav-->
            </div>
        </div>
    </div>
@stop

@section('content_page')
    <div class="alert alert-brand fade show" role="alert">
        <div class="alert-text">
            <strong>INFO</strong> : This view is loaded from module: {!! config('framework.domain.config.name') !!}
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>

    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            @include('partials.flash')

            <!--begin: Datatable -->
            <div class="kt-datatable" id="domains_datatable"></div>
            <!--end: Datatable -->
        </div>
    </div>
    <!--end::Portlet-->
@stop

@push('scripts')
    <!--begin::Page Snippets -->
    <script type="text/javascript">
        // On document ready
        KTUtil.ready(function() {
            var target = '#domains_datatable';
            var url = '{!! route('admin.domains_datatable') !!}';
            var columns = [{
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
                field: 'title',
                title: 'Titre'
            }, {
                field: 'name',
                title: 'Nom'
            }, {
                field: 'folder',
                title: 'Dossier'
            }, {
                field: 'actions',
                title: 'Actions',
                width: 100,
                sortable: false
            }];

            MyListDatatable.init(target, url, columns);
        });
    </script>
    <!--end::Page Snippets -->
@endpush
