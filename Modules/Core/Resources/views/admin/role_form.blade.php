@extends('layouts.master')

@if (isset($role))
    @section('title_page', 'Gestion des rôles : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.users.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Utilisateurs'];
            $items[] = ['link' => route('admin.roles.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Rôles'];
            $items[] = ['link' => $role->url_backend->edit, 'class' => 'text-dark', 'label' => $role->name];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des rôles : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.users.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Utilisateurs'];
            $items[] = ['link' => route('admin.roles.index'), 'class' => 'text-dark', 'label' => 'Rôles'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.roles.index') }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    <x-form :form="$form" />
@endsection
