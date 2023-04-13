<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!-- begin:: Page -->
    <div class="d-flex flex-row flex-column-fluid page">
        @include('partials.aside-left')

        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include('partials.header')

            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                @include('partials.subheader')

                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        @yield('content_page')
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->

            @include('partials.footer')
        </div>
        <!--end::Wrapper-->
    </div>
    <!-- end:: Page -->
</div>
<!--end::Main-->
