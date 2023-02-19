@extends('layouts.master')

@if (isset($page))
    @section('title_page', 'Gestion des pages : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.pages.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Pages'];
            $items[] = ['link' => $page->url_backend->edit, 'class' => 'text-dark', 'label' => $page->title];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des pages : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.pages.index'), 'class' => 'text-dark', 'label' => 'Pages'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.pages.index') }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    <x-form :form="$form" />
@endsection

@push('styles')
    <style type="text/css">
        /*.grapesjs_container .fa {font-family: FontAwesome;}
        .grapesjs_container label, .gjs-two-color {color: #b9a5a6 !important;}
        .gjs-radio-item-label {margin: 0 auto;}
        .icons-flex {
            width: 27px;
            min-height: 25px;
            height: 100%;
            background-size: 70% 65% !important;
            opacity: 0.9;
        }
        .icon-dir-row {
            background: url('/images/grapesjs/flex-dir-row.png') no-repeat center;
        }
        .icon-dir-row-rev {
            background: url('/images/grapesjs/flex-dir-row-rev.png') no-repeat center;
        }
        .icon-dir-col {
            background: url('/images/grapesjs/flex-dir-col.png') no-repeat center;
        }
        .icon-dir-col-rev {
            background: url('/images/grapesjs/flex-dir-col-rev.png') no-repeat center;
        }
        .icon-just-start{
            background: url('/images/grapesjs/flex-just-start.png') no-repeat center;
        }
        .icon-just-end{
            background: url('/images/grapesjs/flex-just-end.png') no-repeat center;
        }
        .icon-just-sp-bet{
            background: url('/images/grapesjs/flex-just-sp-bet.png') no-repeat center;
        }
        .icon-just-sp-ar{
            background: url('/images/grapesjs/flex-just-sp-ar.png') no-repeat center;
        }
        .icon-just-sp-cent{
            background: url('/images/grapesjs/flex-just-sp-cent.png') no-repeat center;
        }
        .icon-al-start{
            background: url('/images/grapesjs/flex-al-start.png') no-repeat center;
        }
        .icon-al-end{
            background: url('/images/grapesjs/flex-al-end.png') no-repeat center;
        }
        .icon-al-str{
            background: url('/images/grapesjs/flex-al-str.png') no-repeat center;
        }
        .icon-al-center{
            background: url('/images/grapesjs/flex-al-center.png') no-repeat center;
        }*/
    </style>
@endpush

@push('scripts')
    <script type="module">
        import {VisualEditor, Text, Select, HTMLText, Repeater} from 'https://unpkg.com/@boxraiser/visual-editor@0.0.23/VisualEditor.standalone.js';
        
        const editor = new VisualEditor();
        editor.registerComponent('hero', {
            title: 'Hero',
            fields: [
                Text('title', {label: 'Title'}),
                HTMLText('content', {label: 'Content'}),
                Repeater('actions', {
                    label: 'Buttons',
                    fields: [
                        Text('label', { label: 'Label', default: 'Call to action' }),
                        Text('url', { label: 'Link' }),
                        Select('type', {
                            default: 'primary',
                            label: 'type',
                            options: [
                                { label: 'Primary', value: 'primary' },
                                { label: 'Secondary', value: 'secondary' }
                            ]
                        })
                    ]
                })
            ]
        });
        editor.defineElement();
    </script>

    <?php /*
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $('.grapesjs_container').each(function() {
                var grapesjs_container = $(this);
                var editor = grapesjs.init({
                    container: '#' + grapesjs_container.attr('id'),
                    avoidInlineStyle: true,
                    fromElement: true,
                    showOffsets: true,
                    selectorManager: {componentFirst: true},
                    storageManager: {type: null},
                    styleManager: {clearProperties: true},
                    plugins: ['gjs-preset-webpage', 'gjs-plugin-ckeditor'],
                    pluginsOpts: {
                        'gjs-preset-webpage': {
                            blocksBasicOpts: {flexGrid: true},
                            customStyleManager: [{
                                name: 'General',
                                buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'],
                                properties: [{
                                    name: 'Alignment',
                                    property: 'float',
                                    type: 'radio',
                                    defaults: 'none',
                                    list: [
                                        {value: 'none', className: 'fa fa-times'},
                                        {value: 'left', className: 'fa fa-align-left'},
                                        {value: 'right', className: 'fa fa-align-right'}
                                    ],
                                },
                                {
                                    property: 'position',
                                    type: 'select'
                                }]
                            }, {
                                name: 'Dimension',
                                open: false,
                                buildProps: ['width', 'height', 'min-width', 'max-width', 'min-height', 'max-height', 'margin', 'padding'],
                                properties: [{
                                    property: 'margin',
                                    properties: [
                                        {name: 'Top', property: 'margin-top'},
                                        {name: 'Right', property: 'margin-right'},
                                        {name: 'Bottom', property: 'margin-bottom'},
                                        {name: 'Left', property: 'margin-left'}
                                    ]
                                }, {
                                    property : 'padding',
                                    properties: [
                                        {name: 'Top', property: 'padding-top'},
                                        {name: 'Right', property: 'padding-right'},
                                        {name: 'Bottom', property: 'padding-bottom'},
                                        {name: 'Left', property: 'padding-left'}
                                    ]
                                }]
                            }, {
                                name: 'Typography',
                                open: false,
                                buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing', 'color', 'line-height', 'text-align', 'text-decoration', 'text-shadow'],
                                properties: [
                                    {name: 'Font', property: 'font-family'},
                                    {name: 'Weight', property: 'font-weight'},
                                    {name: 'Font color', property: 'color'},
                                {
                                    property: 'text-align',
                                    type: 'radio',
                                    defaults: 'left',
                                    list: [
                                        {value : 'left', name : 'Left', className: 'fa fa-align-left'},
                                        {value : 'center', name : 'Center', className: 'fa fa-align-center' },
                                        {value : 'right', name : 'Right', className: 'fa fa-align-right'},
                                        {value : 'justify', name : 'Justify', className: 'fa fa-align-justify'}
                                    ]
                                }, {
                                    property: 'text-decoration',
                                    type: 'radio',
                                    defaults: 'none',
                                    list: [
                                        {value: 'none', name: 'None', className: 'fa fa-times'},
                                        {value: 'underline', name: 'underline', className: 'fa fa-underline' },
                                        {value: 'line-through', name: 'Line-through', className: 'fa fa-strikethrough'}
                                    ]
                                }, {
                                    property: 'text-shadow',
                                    properties: [
                                        {name: 'X position', property: 'text-shadow-h'},
                                        {name: 'Y position', property: 'text-shadow-v'},
                                        {name: 'Blur', property: 'text-shadow-blur'},
                                        {name: 'Color', property: 'text-shadow-color'}
                                    ]
                                }],
                            }, {
                                name: 'Decorations',
                                open: false,
                                buildProps: ['opacity', 'border-radius', 'border', 'box-shadow', 'background-bg'],
                                properties: [{
                                    type: 'slider',
                                    property: 'opacity',
                                    defaults: 1,
                                    step: 0.01,
                                    max: 1,
                                    min:0,
                                }, {
                                    property: 'border-radius',
                                    properties : [
                                        {name: 'Top', property: 'border-top-left-radius'},
                                        {name: 'Right', property: 'border-top-right-radius'},
                                        {name: 'Bottom', property: 'border-bottom-left-radius'},
                                        {name: 'Left', property: 'border-bottom-right-radius'}
                                    ]
                                }, {
                                    property: 'box-shadow',
                                    properties: [
                                        {name: 'X position', property: 'box-shadow-h'},
                                        {name: 'Y position', property: 'box-shadow-v'},
                                        {name: 'Blur', property: 'box-shadow-blur'},
                                        {name: 'Spread', property: 'box-shadow-spread'},
                                        {name: 'Color', property: 'box-shadow-color'},
                                        {name: 'Shadow type', property: 'box-shadow-type'}
                                    ]
                                }, {
                                    id: 'background-bg',
                                    property: 'background',
                                    type: 'bg',
                                }]
                            }, {
                                name: 'Extra',
                                open: false,
                                buildProps: ['transition', 'perspective', 'transform'],
                                properties: [{
                                    property: 'transition',
                                    properties: [
                                        {name: 'Property', property: 'transition-property'},
                                        {name: 'Duration', property: 'transition-duration'},
                                        {name: 'Easing', property: 'transition-timing-function'}
                                    ]
                                }, {
                                    property: 'transform',
                                    properties: [
                                        {name: 'Rotate X', property: 'transform-rotate-x'},
                                        {name: 'Rotate Y', property: 'transform-rotate-y'},
                                        {name: 'Rotate Z', property: 'transform-rotate-z'},
                                        {name: 'Scale X', property: 'transform-scale-x'},
                                        {name: 'Scale Y', property: 'transform-scale-y'},
                                        {name: 'Scale Z', property: 'transform-scale-z'}
                                    ]
                                }]
                            }, {
                                name: 'Flex',
                                open: false,
                                properties: [{
                                    name: 'Flex Container',
                                    property: 'display',
                                    type: 'select',
                                    defaults: 'block',
                                    list: [
                                        {value: 'block', name: 'Disable'},
                                        {value: 'flex', name: 'Enable'}
                                    ]
                                }, {
                                    name: 'Flex Parent',
                                    property: 'label-parent-flex',
                                    type: 'integer',
                                }, {
                                    name : 'Direction',
                                    property : 'flex-direction',
                                    type : 'radio',
                                    defaults : 'row',
                                    list : [{
                                        value : 'row',
                                        name : 'Row',
                                        className : 'icons-flex icon-dir-row',
                                        title : 'Row',
                                    }, {
                                        value : 'row-reverse',
                                        name : 'Row reverse',
                                        className : 'icons-flex icon-dir-row-rev',
                                        title : 'Row reverse',
                                    }, {
                                        value : 'column',
                                        name : 'Column',
                                        title : 'Column',
                                        className : 'icons-flex icon-dir-col',
                                    }, {
                                        value : 'column-reverse',
                                        name : 'Column reverse',
                                        title : 'Column reverse',
                                        className : 'icons-flex icon-dir-col-rev',
                                    }]
                                }, {
                                    name : 'Justify',
                                    property : 'justify-content',
                                    type : 'radio',
                                    defaults : 'flex-start',
                                    list : [{
                                        value : 'flex-start',
                                        className : 'icons-flex icon-just-start',
                                        title : 'Start',
                                    }, {
                                        value : 'flex-end',
                                        title : 'End',
                                        className : 'icons-flex icon-just-end',
                                    }, {
                                        value : 'space-between',
                                        title : 'Space between',
                                        className : 'icons-flex icon-just-sp-bet',
                                    }, {
                                        value : 'space-around',
                                        title : 'Space around',
                                        className : 'icons-flex icon-just-sp-ar',
                                    }, {
                                        value : 'center',
                                        title : 'Center',
                                        className : 'icons-flex icon-just-sp-cent',
                                    }]
                                }, {
                                    name : 'Align',
                                    property : 'align-items',
                                    type : 'radio',
                                    defaults : 'center',
                                    list : [{
                                        value : 'flex-start',
                                        title : 'Start',
                                        className : 'icons-flex icon-al-start',
                                    }, {
                                        value : 'flex-end',
                                        title : 'End',
                                        className : 'icons-flex icon-al-end',
                                    }, {
                                        value : 'stretch',
                                        title : 'Stretch',
                                        className : 'icons-flex icon-al-str',
                                    }, {
                                        value : 'center',
                                        title : 'Center',
                                        className : 'icons-flex icon-al-center',
                                    }]
                                }, {
                                    name: 'Flex Children',
                                    property: 'label-parent-flex',
                                    type: 'integer',
                                }, {
                                    name: 'Order',
                                    property: 'order',
                                    type: 'integer',
                                    defaults : 0,
                                    min: 0
                                }, {
                                    name : 'Flex',
                                    property : 'flex',
                                    type : 'composite',
                                    properties : [{
                                        name: 'Grow',
                                        property: 'flex-grow',
                                        type: 'integer',
                                        defaults : 0,
                                        min: 0
                                    }, {
                                        name: 'Shrink',
                                        property: 'flex-shrink',
                                        type: 'integer',
                                        defaults : 0,
                                        min: 0
                                    }, {
                                        name: 'Basis',
                                        property: 'flex-basis',
                                        type: 'integer',
                                        units: ['px','%',''],
                                        unit: '',
                                        defaults : 'auto',
                                    }]
                                }, {
                                    name : 'Align',
                                    property : 'align-self',
                                    type : 'radio',
                                    defaults : 'auto',
                                    list : [{
                                        value : 'auto',
                                        name : 'Auto',
                                    }, {
                                        value : 'flex-start',
                                        title : 'Start',
                                        className : 'icons-flex icon-al-start',
                                    }, {
                                        value : 'flex-end',
                                        title : 'End',
                                        className : 'icons-flex icon-al-end',
                                    }, {
                                        value : 'stretch',
                                        title : 'Stretch',
                                        className : 'icons-flex icon-al-str',
                                    }, {
                                        value : 'center',
                                        title : 'Center',
                                        className : 'icons-flex icon-al-center',
                                    }]
                                }]
                            }]
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

                // var blockManager = editor.BlockManager;
                // blockManager.add('my-first-block', {
                //     label: 'Simple block',
                //     content: '<div class="my-block">This is a simple block</div>',
                // });

                editor.on('component:update', function() {
                    update_textarea(editor);
                });

                function update_textarea(editor) {
                    $('#' + $(editor.getContainer()).data('textarea')).val('<style>' + editor.getCss() + '</style>' + editor.getHtml());
                }
            });
        });
    </script>
    */ ?>
@endpush
