<div class="d-flex flex-row gap-2">
    @if (!empty($items['edit']))
    <a href="{{ $items['edit']['link'] }}" class="btn btn-sm btn-icon btn-light-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $items['edit']['label'] }}">
        <i class="ki-duotone ki-pencil fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </a>
    @endif

    @if (!empty($items['duplicate']))
    <a href="{{ $items['duplicate']['link'] }}" class="btn btn-sm btn-icon btn-light-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $items['duplicate']['label'] }}">
        <i class="ki-duotone ki-copy fs-1"></i>
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

    @if (!empty($items['more']))
    <a href="#" class="btn btn-sm btn-icon btn-light-dark" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
        <i class="ki-duotone ki-dots-horizontal fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
    </a>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
        @foreach ($items['more'] as $more_item)
        <div class="menu-item px-3">
            <a href="{{ $more_item['link'] }}" class="menu-link px-3">{{ $more_item['label'] }}</a>
        </div>
        @endforeach
    </div>
    @endif
</div>
