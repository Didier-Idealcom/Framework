@extends('layouts.master')

@section('title_page', 'Prévisualisation du formulaire')

@section('breadcrumb')
    <div class="subheader-separator subheader-separator-ver mr-5 bg-gray-200"></div>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted"><i class="flaticon2-shelter"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.formulaires.index') }}" class="text-muted">Formulaires</a></li>
        <li class="breadcrumb-item"><span class="text-muted">« {{ $formulaire->title }} »</span></li>
    </ul>
@endsection

@section('subheader_toolbar')
    <div class="d-flex align-items-center">
        <!--begin::Button-->
        <a href="{{ route('admin.formulaires.index') }}" class="btn btn-light-primary font-weight-bold btn-sm px-4 font-size-base ml-2">Back</a>
        <!--end::Button-->
    </div>
@endsection

@section('content_page')
    <!-- begin: Portlet -->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <!-- begin: Form -->
            {!! form_start($form) !!}
            {{-- form($form) --}}
            {!! form_rest($form) !!}
            <!-- end: Form -->
        </div>
    </div>
    <!-- end: Portlet -->
@endsection
