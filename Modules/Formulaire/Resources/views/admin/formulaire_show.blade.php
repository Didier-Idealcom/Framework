@extends('layouts.master')

@section('title_page', 'Prévisualisation du formulaire')

@section('breadcrumb')
    @php
        $items = [];
        $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
        $items[] = ['link' => route('admin.formulaires.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Formulaires'];
        $items[] = ['link' => $formulaire->url_backend->edit, 'class' => 'text-dark', 'label' => $formulaire->title];
    @endphp
    <x-breadcrumb :items="$items" />
@endsection

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.formulaires.index') }}" />
@endsection

@section('content_page')
    <x-form :form="$form" />
@endsection
