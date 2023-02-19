<div>
    <h1>{{ $title }}</h1>
    <div>{!! $content !!}</div>
    <div>
        @foreach ($actions as $action)
            <a href="{{ $action['url'] }}" class="{{ $action['type'] }}">{{ $action['label'] }}</a>
        @endforeach
    </div>
</div>
