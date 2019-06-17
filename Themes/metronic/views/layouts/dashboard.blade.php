@section('content')
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        @include('partials.header')

        @include('partials.main')

        @include('partials.footer')
    </div>
    <!-- end:: Page -->

    @include('partials.aside-right')

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->
@endsection
