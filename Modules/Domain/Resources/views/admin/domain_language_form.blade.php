@extends('layouts.master')

@if (isset($domain_language))
    @section('title_page', 'Gestion des langues du domaine : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.domains.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Domaines'];
            $items[] = ['link' => $domain->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => $domain->title];
            //$items[] = ['link' => route('admin.domains_languages.index', $domain->id), 'class' => 'text-muted text-hover-primary', 'label' => 'Langues'];
            $items[] = ['link' => $domain->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => 'Langues'];
            $items[] = ['link' => $domain_language->url_backend->edit, 'class' => 'text-dark', 'label' => $domain_language->language->name];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des langues du domaine : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.domains.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Domaines'];
            $items[] = ['link' => $domain->url_backend->edit, 'class' => 'text-muted text-hover-primary', 'label' => $domain->title];
            $items[] = ['link' => route('admin.domains_languages.index', $domain->id), 'class' => 'text-dark', 'label' => 'Langues'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.domains_languages.index', $domain->id) }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    @php
        $items = [];
        $items[] = ['link' => $domain->url_backend->edit, 'label' => 'Fiche détail', 'active' => false];
        $items[] = ['link' => 'javascript:;', 'label' => 'Langues', 'active' => true];
    @endphp
    <x-tabs :items="$items" />

    <x-form :form="$form" />
@endsection
