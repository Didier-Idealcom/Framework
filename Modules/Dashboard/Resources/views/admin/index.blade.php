@extends('layouts.master')

@section('title_page', 'Dashboard')

@section('content_page')
    <div class="alert alert-custom alert-primary alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>INFO</strong> : This view is loaded from module: {!! config('framework.dashboard.config.name') !!}
    </div>
@endsection
