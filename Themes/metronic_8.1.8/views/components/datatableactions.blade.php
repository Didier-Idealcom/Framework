<div class="d-flex flex-row gap-2">
    @if (!empty($items['edit']))
    <a href="{{ $items['edit']['link'] }}" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $items['edit']['label'] }}">
        <i class="ki-duotone ki-pencil fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </a>
    @endif

    @if (!empty($items['delete']))
    <form action="{{ $items['delete']['link'] }}" method="POST" class="form-delete d-inline-flex">
        {{ method_field("DELETE") }}
        {{ csrf_field() }}
        <button class="btn btn-sm btn-icon btn-light-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $items['delete']['label'] }}">
            <i class="ki-duotone ki-eraser fs-1">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
        </button>
    </form>
    @endif

    @if (!empty($items['preview']))
    <a href="{{ $items['preview']['link'] }}" class="btn btn-sm btn-icon btn-light-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $items['preview']['label'] }}">
        <i class="ki-duotone ki-design-frame fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </a>
    @endif

    @if (!empty($items['more']))
    <a href="{{ $items['more']['link'] }}" class="btn btn-sm btn-icon btn-light-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $items['more']['label'] }}">
        <i class="ki-duotone ki-dots-square fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
        </i>
    </a>
    @endif
</div>
