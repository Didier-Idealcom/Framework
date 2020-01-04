@extends('layouts.master')

@if (isset($page))
    @section('title_page', 'Edition de la page')
    @section('breadcrumb')
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        <div class="kt-subheader__breadcrumbs">
            <span class="kt-subheader__desc">{{ $page->title }}</span>
        </div>
    @stop
@else
    @section('title_page', 'Création d\'une nouvelle page')
@endif

@section('subheader_toolbar')
<div class="kt-subheader__toolbar">
    <a href="{{ route('admin.pages.index') }}" class="btn btn-default btn-bold">Back</a>

    <div class="btn-group">
        <button type="button" href="#save_close" class="btn btn-brand btn-bold my-link__save">Save Changes</button>
        <button type="button" class="btn btn-brand btn-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
            <ul class="kt-nav">
                <li class="kt-nav__item">
                    <a href="#save_stay" class="kt-nav__link my-link__save">
                        <i class="kt-nav__link-icon flaticon2-writing"></i>
                        <span class="kt-nav__link-text">Save &amp; Stay</span>
                    </a>
                </li>
                <li class="kt-nav__item">
                    <a href="#save_new" class="kt-nav__link my-link__save">
                        <i class="kt-nav__link-icon flaticon2-medical-records"></i>
                        <span class="kt-nav__link-text">Save &amp; New</span>
                    </a>
                </li>
                <li class="kt-nav__item">
                    <a href="#save_close" class="kt-nav__link my-link__save">
                        <i class="kt-nav__link-icon flaticon2-hourglass-1"></i>
                        <span class="kt-nav__link-text">Save &amp; Close</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop

@section('content_page')
    <!-- begin: Portlet -->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('partials.flash')

            <!-- begin: Form -->
            {!! form_start($form) !!}
            {{-- form($form) --}}
            {!! form_rest($form) !!}

            <div class="d-none">
                <button type="submit" name="save" id="save_new" value="save_new">Save &amp; New</button>
                <button type="submit" name="save" id="save_stay" value="save_stay">Save &amp; Stay</button>
                <button type="submit" name="save" id="save_close" value="save_close">Save &amp; Close</button>
            </div>
            {!! form_end($form, false) !!}
            <!-- end: Form -->
        </div>
    </div>
    <!-- end: Portlet -->
@stop

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
