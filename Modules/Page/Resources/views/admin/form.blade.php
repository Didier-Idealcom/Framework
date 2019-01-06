@extends('layouts.master')

@section('title_page', 'Gestion des pages')

@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
               <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="javascript:;" class="m-nav__link">
                <span class="m-nav__link-text">Contenus</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.pages.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Pages</span>
            </a>
        </li>
    </ul>
@stop

@section('content_page')
    {!! form_start($form) !!}
    <!-- begin: Portlet -->
    <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-wrapper">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="flaticon-edit"></i>
                        </span>
                        <?php if (isset($page)): ?>
                        <h3 class="m-portlet__head-text">Edition de la page : <?php echo $page->title; ?></h3>
                        <?php else: ?>
                        <h3 class="m-portlet__head-text">Création d'une nouvelle page</h3>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                        <span>
                            <i class="la la-arrow-left"></i>
                            <span>Back</span>
                        </span>
                    </a>

                    <div class="btn-group">
                        <button type="submit" name="save" class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md">
                            <span>
                                <i class="la la-check"></i>
                                <span>Save</span>
                            </span>
                        </button>
                        <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split m-btn m-btn--md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                            <button type="submit" name="save" value="save_new" class="btn dropdown-item"><i class="la la-plus"></i> Save &amp; New</button>
                            <button type="submit" name="save" value="save_stay" class="btn dropdown-item"><i class="la la-save"></i> Save &amp; Stay</button>
                            <button type="submit" name="save" class="btn dropdown-item"><i class="la la-undo"></i> Save &amp; Close</button>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="la la-close"></i> Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            @include('partials.flash')

            <!-- begin: Form -->
            {{-- form($form) --}}
            {!! form_rest($form) !!}
            <!-- end: Form -->
        </div>
    </div>
    <!-- end: Portlet -->
    {!! form_end($form, false) !!}
@stop

@push('styles')

@endpush

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
