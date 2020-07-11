@extends('layouts.master')

@if (isset($page))
    @section('title_page', 'Gestion des pages : Edition')

    @section('breadcrumb')
        <div class="subheader-separator subheader-separator-ver mr-5 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted"><i class="flaticon2-shelter"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}" class="text-muted">Pages</a></li>
            <li class="breadcrumb-item"><span class="text-muted">« {{ $page->title }} »</span></li>
        </ul>
    @endsection
@else
    @section('title_page', 'Gestion des pages : Création')

    @section('breadcrumb')
        <div class="subheader-separator subheader-separator-ver mr-5 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted"><i class="flaticon2-shelter"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}" class="text-muted">Pages</a></li>
        </ul>
    @endsection
@endif

@section('subheader_toolbar')
    <div class="d-flex align-items-center">
        <!--begin::Button-->
        <a href="{{ route('admin.pages.index') }}" class="btn btn-light-primary font-weight-bold btn-sm px-4 font-size-base ml-2">Back</a>
        <!--end::Button-->

        @include('partials.dropdown_save')
    </div>
@endsection

@section('content_page')
    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Card body-->
        <div class="card-body">
            @include('partials.flash')

            <!-- begin: Form -->
            {!! form_start($form) !!}
            {{-- form($form) --}}
            {!! form_rest($form) !!}

            <div class="d-none">
                <button type="submit" name="save" id="save_close" value="save_close">Save &amp; Close</button>
                <button type="submit" name="save" id="save_stay" value="save_stay">Save &amp; Stay</button>
                <button type="submit" name="save" id="save_new" value="save_new">Save &amp; New</button>
            </div>
            {!! form_end($form, false) !!}
            <!-- end: Form -->
        </div>
        <!--end::Card body-->
    </div>
    <!-- end::Card -->
@endsection

@push('scripts')
    <script src="//cdn.ckeditor.com/4.8.0/full-all/ckeditor.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $('.grapesjs_container').each(function() {
                var grapesjs_container = $(this);
                var editor = grapesjs.init({
                    container: '#' + grapesjs_container.attr('id'),
                    fromElement: true,
                    storageManager: {type: null},
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

                var panel = editor.Panels;
                panel.getButton('options', 'sw-visibility').set('active', true);

                /*var blockManager = editor.BlockManager;
                blockManager.add('my-first-block', {
                    label: 'Simple block',
                    content: '<div class="my-block">This is a simple block</div>',
                });*/

                editor.on('component:update', function() {
                    update_textarea(editor);
                });

                function update_textarea(editor) {
                    $('#' + $(editor.getContainer()).data('textarea')).val('<style>' + editor.getCss() + '</style>' + editor.getHtml());
                }
            });
        });
    </script>
@endpush
