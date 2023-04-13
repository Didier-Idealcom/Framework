<div {{ $attributes->class(['alert', 'alert-' . $type, 'd-flex', 'alert-dismissible flex-column flex-sm-row' => $dismiss]) }}>
    @if (!empty($icon))
    <!--begin::Svg Icon-->
    <span class="svg-icon svg-icon-2hx svg-icon-{{ $type }} me-4">
        {!! purifySvg(svg($icon)) !!}
    </span>
    <!--end::Svg Icon-->
    @endif

    <div class="d-flex flex-column justify-content-center">
        {!! $message !!}
    </div>

    @if ($dismiss === true)
    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-sm btn-icon ms-sm-auto" data-bs-dismiss="alert">
        <!--begin::Svg Icon | path:assets/media/icons/duotone/Interface/Close-Square.svg-->
        <span class="svg-icon svg-icon-1 svg-icon-{{ $type }}">
            {!! purifySvg(svg('duotone/Interface/Close-Square')) !!}
        </span>
        <!--end::Svg Icon-->
    </button>
    @endif
</div>
