@extends('layouts.master')

@if (isset($email))
    @section('title_page', 'Gestion des e-mails : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.emails.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'E-mails'];
            $items[] = ['link' => $email->url_backend->edit, 'class' => 'text-dark', 'label' => $email->name];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des e-mails : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.emails.index'), 'class' => 'text-dark', 'label' => 'E-mails'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.emails.index') }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    <x-form :form="$form" />
@endsection
