@extends('layouts.master')

@if (isset($user))
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
    {!! form_start($form) !!}
    <!-- begin: Portlet -->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('partials.flash')

            <!-- begin: Form -->
            {{-- form($form) --}}
            {!! form_rest($form) !!}
            <!-- end: Form -->
        </div>
    </div>
    <!-- end: Portlet -->

    <div class="d-none">
        <button type="submit" name="save" id="save_new" value="save_new">Save &amp; New</button>
        <button type="submit" name="save" id="save_stay" value="save_stay">Save &amp; Stay</button>
        <button type="submit" name="save" id="save_close" value="save_close">Save &amp; Close</button>
    </div>
    {!! form_end($form, false) !!}
@stop

@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var lang = 'fr';
            $('.input-multilangue').not('.lang-' + lang).parents('.form-group').hide();
            $('.lang-change[data-lang="' + lang + '"]').addClass('active');

            $('.lang-change').on('click', function(e) {
                e.preventDefault();

                if (!$(this).hasClass('active')) {
                    var data_lang = $(this).data('lang');
                    $('.input-multilangue').parents('.form-group').hide();
                    $('.input-multilangue.lang-' + data_lang).parents('.form-group').fadeIn();
                    $('.lang-change').removeClass('active');
                    $('.lang-change[data-lang="' + data_lang + '"]').addClass('active');
                }
            });

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
