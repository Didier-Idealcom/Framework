@extends('layouts.master')

@section('title', 'Metronic | Dashboard')

@section('content')
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        @include('partials.header-base')
        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            @include('partials.aside-left')
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                @include('partials.subheader-default')
                <div class="m-content"></div>
            </div>
        </div>
        <!-- end:: Body -->
        @include('partials.footer-default')
    </div>
    <!-- end:: Page -->
    @include('partials.layout-quick-sidebar')
    @include('partials.layout-scroll-top')
    @include('partials.layout-tooltips')
@endsection
