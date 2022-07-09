@extends('layouts.master')

@if (isset($menuitem))
    @section('title_page', 'Gestion des items du menu : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.menus.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Menus'];
            $items[] = ['link' => $menu->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => $menu->title];
            $items[] = ['link' => route('admin.menuitems.index', $menu->id), 'class' => 'text-muted text-hover-primary', 'label' => 'Menuitems'];
            $items[] = ['link' => $menuitem->url_backend->edit, 'class' => 'text-dark', 'label' => $menuitem->title_menu];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des items du menu : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.menus.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Menus'];
            $items[] = ['link' => $menu->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => $menu->title];
            $items[] = ['link' => route('admin.menuitems.index', $menu->id), 'class' => 'text-dark', 'label' => 'Menuitems'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.menuitems.index', $menu->id) }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    @php
        $items = [];
        $items[] = ['link' => $menu->url_backend->edit, 'label' => 'Fiche détail', 'active' => false];
        $items[] = ['link' => 'javascript:;', 'label' => 'Menuitems', 'active' => true];
    @endphp
    <x-tabs :items="$items" />

    <x-form :form="$form" />
@endsection
