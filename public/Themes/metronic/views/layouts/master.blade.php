<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Version: 5.2
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
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->

    <!--begin::Base Styles -->
    <link href="{{ themes('vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ themes('demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Base Styles -->

    @stack('styles')

    <link rel="shortcut icon" href="{{ themes('demo/default/media/img/logo/favicon.ico') }}" />
</head>
<!-- end::Head -->

<!-- begin::Body -->
<body class="m-page--fluid m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-aside--offcanvas-default m-footer--fixed m-footer--push">
    @include('layouts.dashboard')

    @yield('content')

    <!--begin::Base Scripts -->
    <script src="//cdn.ckeditor.com/4.10.1/full/ckeditor.js"></script>
    <script src="{{ themes('vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ themes('demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Base Scripts -->

    @stack('scripts')
</body>
<!-- end::Body -->
</html>
