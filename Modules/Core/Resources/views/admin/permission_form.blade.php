@extends('layouts.master')

@if (isset($permission))
    @section('title_page', 'Gestion des permissions : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.users.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Utilisateurs'];
            $items[] = ['link' => route('admin.permissions.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Permissions'];
            $items[] = ['link' => $permission->url_backend->edit, 'class' => 'text-dark', 'label' => $permission->name];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des permissions : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.users.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Utilisateurs'];
            $items[] = ['link' => route('admin.permissions.index'), 'class' => 'text-dark', 'label' => 'Permissions'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.permissions.index') }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    <x-form :form="$form" />
@endsection
