<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">@yield('title_page')</h5>
            <!--end::Page Title-->

            @yield('breadcrumb')
        </div>
        <!--end::Info-->

        @yield('subheader_toolbar')
    </div>
</div>
<!--end::Subheader-->
