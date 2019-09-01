<!-- begin::Body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
    <button class="m-aside-left-close m-aside-left-close--skin-dark" id="m_aside_left_close_btn"><i class="la la-close"></i></button>

    @include('partials.aside-left')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h1 class="m-subheader__title">@yield('title_page')</h1>

                    @yield('breadcrumb')
                </div>
            </div>
        </div>
        <!-- END: Subheader -->

        <div class="m-content">
            @yield('content_page')
        </div>
    </div>
</div>
<!-- end:: Body -->
