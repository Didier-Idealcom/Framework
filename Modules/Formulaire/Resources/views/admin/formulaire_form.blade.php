@extends('layouts.master')

@if (isset($formulaire))
    @section('title_page', 'Gestion des formulaires : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.formulaires.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Formulaires'];
            $items[] = ['link' => $formulaire->url_backend->edit, 'class' => 'text-dark', 'label' => $formulaire->title];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des formulaires : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.formulaires.index'), 'class' => 'text-dark', 'label' => 'Formulaires'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.formulaires.index') }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    @if (isset($formulaire))
        @php
            $items = [];
            $items[] = ['link' => 'javascript:;', 'label' => 'Fiche détail', 'active' => true];
            $items[] = ['link' => route('admin.formulaires_fields.index', $formulaire->id), 'label' => 'Champs', 'active' => false];
        @endphp
        <x-tabs :items="$items" />
    @endif

    <x-form :form="$form" />
@endsection
