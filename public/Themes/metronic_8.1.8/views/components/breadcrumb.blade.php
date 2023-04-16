<ul class="breadcrumb breadcrumb-line fw-semibold fs-7 my-0 pt-1">
    @foreach ($items as $item)
    @if (!empty($item['link']))
    <li class="breadcrumb-item"><a href="{{ $item['link'] }}" class="{{ $item['class'] }}">{{ $item['label'] }}</a></li>
    @else
    <li class="breadcrumb-item"><span class="{{ $item['class'] }}">{{ $item['label'] }}</span></li>
    @endif
    @endforeach
</ul>
