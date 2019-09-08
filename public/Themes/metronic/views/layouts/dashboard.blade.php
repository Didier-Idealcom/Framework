@section('content')
    <!-- begin:: Page -->
    @include('partials.header-mobile')

    @include('partials.main')
    <!-- end:: Page -->

    @include('partials.aside-right')

    @include('partials.sticky-toolbar')

    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>
    <!-- end::Scrolltop -->
@endsection
