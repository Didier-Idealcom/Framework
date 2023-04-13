<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        @include('partials.aside-left')

        <!--begin::Wrapper-->
        <div id="kt_wrapper" class="wrapper d-flex flex-column flex-row-fluid">
            @include('partials.header')

            <!--begin::Content-->
            <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
                @include('partials.subheader')

                <!--begin::Post-->
                <div id="kt_post" class="post d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-fluid">
                        @yield('content_page')
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->

            @include('partials.footer')
        </div>
        <!--end::Wrapper-->
    </div>
    <!-- end:: Page -->
</div>
<!--end::Root-->

@include('partials.aside-right')

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <span class="svg-icon">
        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
        {!! purifySvg(svg('icons/Navigation/Up-2')) !!}
        <!--end::Svg Icon-->
    </span>
</div>
<!--end::Scrolltop-->
