@if (!empty($items))
<!--begin:::Tabs-->
<ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
    @foreach ($items as $item)
    <!--begin:::Tab item-->
    <li class="nav-item"><a href="{{ $item['link'] }}" class="nav-link text-active-primary pb-4 {{ $item['active'] ? 'active' : '' }}">{{ $item['label'] }}</a></li>
    <!--end:::Tab item-->
    @endforeach
</ul>
<!--end:::Tabs-->
@endif
