@extends('layouts.master')

@section('title_page', 'Gestion des e-mails')

@section('breadcrumb')
    <div class="subheader-separator subheader-separator-ver mr-5 bg-gray-200"></div>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted"><i class="flaticon2-shelter"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.emails.index') }}" class="text-muted">E-mails</a></li>
    </ul>
@endsection

@section('subheader_toolbar')
    <div class="d-flex align-items-center">
        <!--begin::Button-->
        <a href="{{ route('admin.emails.create') }}" class="btn btn-light-primary font-weight-bold btn-sm px-4 font-size-base ml-2">Ajouter</a>
        <!--end::Button-->

        <!--begin::Dropdown-->
        <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
            <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-icon-success svg-icon-2x">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                    {!! svg(theme_url('media/svg/icons/Files/') . 'File-plus') !!}
                    <!--end::Svg Icon-->
                </span>
            </a>
            <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right">
                <!--begin::Navigation-->
                <ul class="navi">
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-icon">
                                <i class="flaticon2-shopping-cart-1"></i>
                            </span>
                            <span class="navi-text">Importer</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a href="#" class="navi-link">
                            <span class="navi-icon">
                                <i class="flaticon2-shopping-cart-1"></i>
                            </span>
                            <span class="navi-text">Exporter</span>
                        </a>
                    </li>
                </ul>
                <!--end::Navigation-->
            </div>
        </div>
        <!--end::Dropdown-->
    </div>
@endsection

@section('content_page')
    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Card body-->
        <div class="card-body">
            @include('partials.flash')

            <!--begin::Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom" id="emails_datatable"></div>
            <!--end::Datatable-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection

@push('scripts')
    <!--begin::Page Snippets -->
    <script type="text/javascript">
        // On document ready
        KTUtil.ready(function() {
            var target = '#emails_datatable';
            var url = '{!! route('admin.emails_datatable') !!}';
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
                field: 'name',
                title: 'Nom'
            }, {
                field: 'module',
                title: 'Module'
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
