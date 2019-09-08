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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- begin::Fonts -->
    <script>
        WebFontConfig = {
            google: {
                "families": [
                    "Poppins:300,400,500,600,700",
                    "Roboto:300,400,500,700&display=swap"
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

    <!-- begin::Global Theme Styles -->
    <link href="{{ themes('vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ themes('css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <!-- end::Global Theme Styles -->

    <!-- begin::Layout Skins -->
    <link href="{{ themes('css/demo1/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ themes('css/demo1/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ themes('css/demo1/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ themes('css/demo1/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <!-- end::Layout Skins -->

    @stack('styles')

    <link rel="shortcut icon" href="{{ themes('media/logos/favicon.ico') }}" />
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    @include('layouts.dashboard')

    @yield('content')

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "dark": "#282a3c",
                    "light": "#ffffff",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <!-- end::Global Config -->

    <!--begin::Base Scripts -->
    <script>
        var CKEDITOR_BASEPATH = '/plugins/ckeditor/';
    </script>
    <!--end::Base Scripts -->

    <!--begin::Global Theme Bundle -->
    <script src="{{ themes('vendors/global/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ themes('js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->

    <!--begin::Global Custom Scripts -->
    <script src="{{ themes('js/demo1/pages/my-script.js') }}" type="text/javascript"></script>
    <!--end::Global Custom Scripts -->

    @stack('scripts')
</body>
<!-- end::Body -->
</html>
