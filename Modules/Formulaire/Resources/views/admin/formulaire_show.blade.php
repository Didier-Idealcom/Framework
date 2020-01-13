@extends('layouts.master')

@section('title_page', 'Prévisualisation du formulaire')
@section('breadcrumb')
    <span class="kt-subheader__separator kt-subheader__separator--v"></span>
    <div class="kt-subheader__breadcrumbs">
        <span class="kt-subheader__desc">{{ $formulaire->title }}</span>
    </div>
@stop

@section('subheader_toolbar')
<div class="kt-subheader__toolbar">
    <a href="{{ route('admin.formulaires.index') }}" class="btn btn-default btn-bold">Back</a>
</div>
@stop

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
@stop
