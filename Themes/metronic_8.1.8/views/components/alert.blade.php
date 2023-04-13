@php
    /**
     * Usage :
     * <x-alert type="primary" :message="$message" :icon="$icon" :dismiss="$dismiss" />
     */

    // Default icon
    if (empty($icon)) {
        switch ($type) {
            case 'success':
                $icon = 'ki-shield-tick';
                break;

            case 'warning':
            case 'danger':
                $icon = 'ki-information-3';
                break;

            default:
                $icon = 'ki-information-2';
                break;
        }
    }
@endphp

<!--begin::Alert-->
<div {{ $attributes->class(['alert', 'alert-'.$type, 'd-flex align-items-center', 'alert-dismissible flex-column flex-sm-row' => $dismiss]) }}>
    @if (!empty($icon))
    <!--begin::Icon-->
    <i @class(['ki-duotone', $icon, 'text-'.$type, 'fs-3x me-4 mb-5 mb-sm-0'])>
        <span class="path1"></span>
        <span class="path2"></span>
        <span class="path3"></span>
    </i>
    <!--end::Icon-->
    @endif

    <!--begin::Content-->
    <div class="d-flex flex-column justify-content-center">
        {!! $message !!}
    </div>
    <!--end::Content-->

    @if ($dismiss === true)
    <!--begin::Close-->
    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
        <i @class(['ki-duotone ki-cross', 'text-'.$type, 'fs-2x'])>
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </button>
    <!--end::Close-->
    @endif
</div>
<!--end::Alert-->
