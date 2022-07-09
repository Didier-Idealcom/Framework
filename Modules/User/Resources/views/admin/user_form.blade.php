@extends('layouts.master')

@if (isset($user))
    @section('title_page', 'Gestion des utilisateurs : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.users.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Utilisateurs'];
            $items[] = ['link' => $user->url_backend->edit, 'class' => 'text-dark', 'label' => $user->email];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des utilisateurs : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.users.index'), 'class' => 'text-dark', 'label' => 'Utilisateurs'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.users.index') }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    <x-form :form="$form" />
@endsection
