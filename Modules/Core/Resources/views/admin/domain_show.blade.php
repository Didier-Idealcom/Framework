@extends('layouts.master')

@section('content_page')
    {{ 'template domain_show.blade.php' }}
    {{ $domain->name }}
@endsection
