@extends('layouts.master')

@section('title_page', 'Hello World')

@section('content_page')
    <p>
        This view is loaded from module: {!! config('framework.dashboard.config.name') !!}
    </p>

	<div id="grapesjs_container"></div>
@stop

@push('styles')
    <link href="{{ asset('plugins/grapesjs/css/grapes.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/grapesjs/css/grapesjs-preset-webpage.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="//cdn.ckeditor.com/4.8.0/full-all/ckeditor.js" type="text/javascript"></script>
    <script src="{{ asset('plugins/grapesjs/js/grapes.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/grapesjs/js/grapesjs-preset-webpage.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/grapesjs/js/grapesjs-plugin-ckeditor.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var editor = grapesjs.init({
            container: '#grapesjs_container',
            fromElement: true,
            plugins: ['gjs-preset-webpage', 'gjs-plugin-ckeditor'],
            pluginsOpts: {
                'gjs-preset-webpage': {

                },
                'gjs-plugin-ckeditor': {
                    options: {
                        language: 'fr'
                    }
                }
            }
        });

        /*var blockManager = editor.BlockManager;
        blockManager.add('my-first-block', {
            label: 'Simple block',
            content: '<div class="my-block">This is a simple block</div>',
        });*/
    </script>
@endpush
