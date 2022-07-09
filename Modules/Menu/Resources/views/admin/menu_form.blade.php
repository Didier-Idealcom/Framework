@extends('layouts.master')

@if (isset($menu))
    @section('title_page', 'Gestion des menus : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.menus.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Menus'];
            $items[] = ['link' => $menu->url_backend->edit, 'class' => 'text-dark', 'label' => $menu->title];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des menus : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.menus.index'), 'class' => 'text-dark', 'label' => 'Menus'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.menus.index') }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    @if (isset($menu))
        @php
            $items = [];
            $items[] = ['link' => 'javascript:;', 'label' => 'Fiche détail', 'active' => true];
            $items[] = ['link' => route('admin.menuitems.index', $menu->id), 'label' => 'Menuitems', 'active' => false];
        @endphp
        <x-tabs :items="$items" />
    @endif

    <x-form :form="$form" />
@endsection
