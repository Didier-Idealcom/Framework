@extends('layouts.app')

@section('content')
    @if (!empty($page_blocks))
        <!-- Preview -->
        <div id="ve-components">
            @foreach ($page_blocks as $page_block)
                @include('page_blocks.' . $page_block['_name'], $page_block)
            @endforeach
        </div>
    @else
        <!-- Show -->
        @php
            $lang = request()->query('lang');
            $page_blocks = json_decode($page->translate($lang)->content, true);
        @endphp
        @foreach ($page_blocks as $page_block)
            @include('page_blocks.' . $page_block['_name'], $page_block)
        @endforeach
    @endif
@endsection
