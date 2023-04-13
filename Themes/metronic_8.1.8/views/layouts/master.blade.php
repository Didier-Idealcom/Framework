<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.1.8
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="{{ config('app.locale') }}" >
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Administration Metronic')</title>
    <meta name="description" content="@yield('description', 'Administration du site Metronic')">
    <meta name="keywords" content="@yield('keywords', '')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ theme_url('media/logos/favicon.ico') }}" />

    <!--begin::Fonts-->
    <script>
        WebFontConfig = {
            google: {
                "families": [
                    "Inter:300,400,500,600,700&display=swap"
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

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ theme_url('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <link href="{{ theme_url('css/style.bundle.css') }}" rel="stylesheet" type="text/css" media="none" onload="if (media!='all') media='all'" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
    <!--end::Theme mode setup on page load-->

    @include('layouts.dashboard')

    @yield('content')

    <!--begin::Base Scripts-->
    <script>
        var CKEDITOR_BASEPATH = '{{ str_replace('/assets/', '', theme_url('')) . '/tools/node_modules/ckeditor4/' }}';
    </script>
    <!--end::Base Scripts-->

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ theme_url('plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ theme_url('js/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Global Custom Scripts-->
    <script src="{{ theme_url('js/custom/my-script.js') }}" type="text/javascript"></script>
    <!--end::Global Custom Scripts-->

    @stack('scripts')
</body>
<!--end::Body-->
</html>
