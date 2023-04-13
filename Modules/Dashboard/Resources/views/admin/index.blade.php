@extends('layouts.master')

@section('title_page', 'Dashboard')

@section('content_page')
    @php
        $message = '<strong>INFO</strong>
                    <span>This view is loaded from module: ' .config('framework.dashboard.config.name') . '</span>';
        $dismiss = true;
    @endphp
    <x-alert type="primary" :message="$message" :dismiss="$dismiss" class="mb-10" />
@endsection
