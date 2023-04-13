<span class="h-20px border-gray-200 border-start mx-4"></span>
<ul class="breadcrumb breadcrumb-dot text-muted fw-bold fs-7 my-1">
    @foreach ($items as $item)
    @if (!empty($item['link']))
    <li class="breadcrumb-item"><a href="{{ $item['link'] }}" class="{{ $item['class'] }}">{{ $item['label'] }}</a></li>
    @else
    <li class="breadcrumb-item"><span class="{{ $item['class'] }}">{{ $item['label'] }}</span></li>
    @endif
    @endforeach
</ul>
