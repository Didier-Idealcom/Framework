@extends('layouts.master')

@section('title_page', 'Media')

@section('content_page')
    <form action="{{ route('admin.media_upload') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="file" name="avatar" />
        <input type="submit" value=" Save " />
    </form>
@endsection
