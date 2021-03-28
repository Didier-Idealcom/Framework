<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ config('app.locale') }}" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Administration Metronic')</title>
    <meta name="description" content="@yield('description', 'Administration du site Metronic')">
    <meta name="keywords" content="@yield('keywords', '')">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- begin::Fonts -->
    <script>
        WebFontConfig = {
            google: {
                "families": [
                    "Poppins:300,400,500,600,700&display=swap"
                ]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        };

        (function(d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    <!-- end::Fonts -->

    @stack('styles')

    <!-- begin::Global Theme Styles -->
    <link href="{{ theme_url('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ theme_url('css/style.bundle.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <!-- end::Global Theme Styles -->

    <!-- begin::Layout Skins -->
    <link href="{{ theme_url('css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ theme_url('css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ theme_url('css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ theme_url('css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <!-- end::Layout Skins -->

    <link rel="shortcut icon" href="{{ theme_url('media/logos/favicon.ico') }}" />
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    @include('layouts.dashboard')

    @yield('content')

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1200
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#F3F6F9",
                        "dark": "#212121"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#ECF0F3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#212121",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#ECF0F3",
                    "gray-300": "#E5EAEE",
                    "gray-400": "#D6D6E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#80808F",
                    "gray-700": "#464E5F",
                    "gray-800": "#1B283F",
                    "gray-900": "#212121"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!-- end::Global Config -->

    <!--begin::Base Scripts -->
    <script>
        var CKEDITOR_BASEPATH = '/Themes/metronic/tools/node_modules/ckeditor4/';
    </script>
    <!--end::Base Scripts -->

    <!--begin::Global Theme Bundle -->
    <script src="{{ theme_url('plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ theme_url('js/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->

    <!--begin::Global Custom Scripts -->
    <script src="{{ theme_url('js/pages/my-script.js') }}" type="text/javascript"></script>
    <!--end::Global Custom Scripts -->

    @stack('scripts')
</body>
<!-- end::Body -->
</html>
