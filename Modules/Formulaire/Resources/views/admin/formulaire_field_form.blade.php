@extends('layouts.master')

@if (isset($formulaire_field))
    @section('title_page', 'Gestion des champs du formulaire : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.formulaires.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Formulaires'];
            $items[] = ['link' => $formulaire->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => $formulaire->title];
            $items[] = ['link' => route('admin.formulaires_fields.index', $formulaire->id), 'class' => 'text-muted text-hover-primary', 'label' => 'Champs'];
            $items[] = ['link' => $formulaire_field->url_backend->edit, 'class' => 'text-dark', 'label' => $formulaire_field->label_admin];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des champs du formulaire : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.formulaires.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Formulaires'];
            $items[] = ['link' => $formulaire->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => $formulaire->title];
            $items[] = ['link' => route('admin.formulaires_fields.index', $formulaire->id), 'class' => 'text-dark', 'label' => 'Champs'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.formulaires_fields.index', $formulaire->id) }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    @php
        $items = [];
        $items[] = ['link' => $formulaire->url_backend->edit, 'label' => 'Fiche détail', 'active' => false];
        $items[] = ['link' => 'javascript:;', 'label' => 'Champs', 'active' => true];
    @endphp
    <x-tabs :items="$items" />

    <x-form :form="$form" />
@endsection
