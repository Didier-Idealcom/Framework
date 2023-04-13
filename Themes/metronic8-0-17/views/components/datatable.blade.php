<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            @if ($search === true)
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    {!! purifySvg(svg('duotone/General/Search')) !!}
                </span>
                <!--end::Svg Icon-->
                <input type="text" data-kt-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Recherche" />
            </div>
            <!--end::Search-->
            @endif
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-table-toolbar="base">
                @if ($filter === true)
                <!--begin::Filter-->
                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                    <!--begin::Svg Icon | path: icons/duotone/Text/Filter.svg-->
                    <span class="svg-icon svg-icon-2">
                        {!! purifySvg(svg('duotone/Text/Filter')) !!}
                    </span>
                    <!--end::Svg Icon-->
                    Filtrer
                </button>
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filtres</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Content-->
                    <div class="px-7 py-5" data-kt-table-filter="form">
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-white btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-table-filter="reset">Reset</button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Menu 1-->
                <!--end::Filter-->
                @endif

                @if (!empty($import))
                <a href="{{ $import }}" class="btn btn-light-primary me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Importer">
                    <!--begin::Svg Icon | path:assets/media/icons/duotone/Files/Import.svg-->
                    <span class="svg-icon svg-icon-2 me-0">
                        {!! purifySvg(svg('duotone/Files/Import')) !!}
                    </span>
                    <!--end::Svg Icon-->
                </a>
                @endif

                @if (!empty($export))
                <a href="{{ $export }}" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Exporter">
                    <!--begin::Svg Icon | path:assets/media/icons/duotone/Files/Export.svg-->
                    <span class="svg-icon svg-icon-2 me-0">
                        {!! purifySvg(svg('duotone/Files/Export')) !!}
                    </span>
                    <!--end::Svg Icon-->
                </a>
                @endif
            </div>
            <!--end::Toolbar-->

            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-table-toolbar="selected">
                <div class="fw-bolder me-5">
                <span class="me-2" data-kt-table-select="selected_count"></span>Selected</div>
                <button type="button" class="btn btn-danger" data-kt-table-select="delete_selected">Delete Selected</button>
            </div>
            <!--end::Group actions-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        @include('partials.flash')

        <!--begin::Datatable-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="{{ $id }}">

        </table>
        <!--end::Datatable-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->

@push('styles')
    <!--begin::Page Snippets -->
    <link href="{{ theme_url('/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Snippets -->
@endpush

@push('scripts')
    <!--begin::Page Snippets -->
    <script src="{{ theme_url('/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <!--end::Page Snippets -->
@endpush