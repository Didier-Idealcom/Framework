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
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Administration Metronic')</title>
    <meta name="description" content="@yield('description', 'Administration du site Metronic')">
    <meta name="keywords" content="@yield('keywords', '')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Fonts-->
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
    <!--end::Fonts-->

    @stack('styles')

    <!--begin::Global Theme Styles-->
    <link href="{{ theme_url('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ theme_url('css/style.bundle.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <!--end::Global Theme Styles-->

    <link rel="shortcut icon" href="{{ theme_url('media/logos/favicon.ico') }}" />
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    @include('layouts.dashboard')

    @yield('content')

    <!--begin::Base Scripts-->
    <script>
        var CKEDITOR_BASEPATH = '/Themes/metronic/tools/node_modules/ckeditor4/';
    </script>
    <!--end::Base Scripts-->

    <!--begin::Global Theme Bundle-->
    <script src="{{ theme_url('plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ theme_url('js/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Global Theme Bundle-->

    <!--begin::Global Custom Scripts-->
    <script src="{{ theme_url('js/custom/my-script.js') }}" type="text/javascript"></script>
    <!--end::Global Custom Scripts-->

    @stack('scripts')
</body>
<!--end::Body-->
</html>
