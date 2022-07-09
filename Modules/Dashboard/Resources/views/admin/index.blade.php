@extends('layouts.master')

@section('title_page', 'Dashboard')

@section('content_page')
    @php
        $message = '<strong>INFO</strong>
                    <span>This view is loaded from module: ' .config('framework.dashboard.config.name') . '</span>';
        $icon = 'duotone/Code/Info-circle';
        $dismiss = true;
    @endphp
    <x-alert type="primary" :message="$message" :icon="$icon" :dismiss="$dismiss" class="mb-10" />
@endsection
