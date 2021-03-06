@extends('layouts.master')

@section('title_page', 'Gestion des pages : Prévisualisation')
@section('title_page', 'Gestion des pages : Edition')

@section('breadcrumb')
    <div class="subheader-separator subheader-separator-ver mr-5 bg-gray-200"></div>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted"><i class="flaticon2-shelter"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}" class="text-muted">Pages</a></li>
        <li class="breadcrumb-item"><span class="text-muted">« {{ $page->title }} »</span></li>
    </ul>
@endsection

@section('subheader_toolbar')
    <div class="d-flex align-items-center">
        <!--begin::Button-->
        <a href="{{ route('admin.pages.index') }}" class="btn btn-light-primary font-weight-bold btn-sm px-4 font-size-base ml-2">Back</a>
        <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-light-primary font-weight-bold btn-sm px-4 font-size-base ml-2">Edit</a>
        <!--end::Button-->
    </div>
@endsection

@section('content_page')
    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Card body-->
        <div class="card-body">
            {!! $page->content !!}
        </div>
        <!--end::Card body-->
    </div>
    <!-- end::Card -->
@endsection
