@extends('layouts.master')

@section('title_page', 'Hello World')

@section('content_page')
    <p>
        This view is loaded from module: {!! config('framework.product.config.name') !!}
    </p>
@stop
