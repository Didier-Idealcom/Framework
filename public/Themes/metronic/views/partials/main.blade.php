<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        @include('partials.aside-left')

        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            @include('partials.header')

            <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                @include('partials.subheader')

                <!-- begin:: Content -->
                <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
                    @yield('content_page')
                </div>
                <!-- end:: Content -->
            </div>

            @include('partials.footer')
        </div>
    </div>
</div>
