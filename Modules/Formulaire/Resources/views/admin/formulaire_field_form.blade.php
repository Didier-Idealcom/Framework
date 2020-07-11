@extends('layouts.master')

@if (isset($formulaire_field))
    @section('title_page', 'Gestion des champs du formulaire : Edition')

    @section('breadcrumb')
        <div class="subheader-separator subheader-separator-ver mr-5 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted"><i class="flaticon2-shelter"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.formulaires.index') }}" class="text-muted">Formulaires</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.formulaires.edit', $formulaire->id) }}" class="text-muted">« {{ $formulaire->title }} »</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.formulaires_fields.index', $formulaire->id) }}" class="text-muted">Champs</a></li>
            <li class="breadcrumb-item"><span class="text-muted">« {{ $formulaire_field->label_admin }} »</span></li>
        </ul>
    @endsection
@else
    @section('title_page', 'Gestion des champs du formulaire : Création')

    @section('breadcrumb')
        <div class="subheader-separator subheader-separator-ver mr-5 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted"><i class="flaticon2-shelter"></i></a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.formulaires.index') }}" class="text-muted">Formulaires</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.formulaires.edit', $formulaire->id) }}" class="text-muted">« {{ $formulaire->title }} »</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.formulaires_fields.index', $formulaire->id) }}" class="text-muted">Champs</a></li>
        </ul>
    @endsection
@endif

@section('subheader_toolbar')
    <div class="d-flex align-items-center">
        <!--begin::Button-->
        <a href="{{ route('admin.formulaires_fields.index', $formulaire->id) }}" class="btn btn-light-primary font-weight-bold btn-sm px-4 font-size-base ml-2">Back</a>
        <!--end::Button-->

        @include('partials.dropdown_save')
    </div>
@endsection

@section('content_page')
    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Card header-->
        <div class="card-header card-header-tabs-line nav-tabs-line-3x">
            <!--begin::Toolbar-->
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.formulaires.edit', $formulaire->id) }}">Fiche détail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:;">Champs</a>
                    </li>
                </ul>
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body">
            @include('partials.flash')

            <!-- begin: Form -->
            {!! form_start($form) !!}
            {{-- form($form) --}}
            {!! form_rest($form) !!}

            <div class="d-none">
                <button type="submit" name="save" id="save_close" value="save_close">Save &amp; Close</button>
                <button type="submit" name="save" id="save_stay" value="save_stay">Save &amp; Stay</button>
                <button type="submit" name="save" id="save_new" value="save_new">Save &amp; New</button>
            </div>
            {!! form_end($form, false) !!}
            <!-- end: Form -->
        </div>
        <!--end::Card body-->
    </div>
    <!-- end::Card -->
@endsection
