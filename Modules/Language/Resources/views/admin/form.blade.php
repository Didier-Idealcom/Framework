@extends('layouts.master')

@section('title_page', 'Gestion des langues')

@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
               <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="javascript:;" class="m-nav__link">
                <span class="m-nav__link-text">Configuration</span>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.languages.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Langues</span>
            </a>
        </li>
    </ul>
@stop

@section('content_page')
    {!! form_start($form) !!}
    <!-- begin: Portlet -->
    <div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
        <div class="m-portlet__head">
            <div class="m-portlet__head-wrapper">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <i class="flaticon-edit"></i>
                        </span>
                        <h3 class="m-portlet__head-text">Création d'une nouvelle langue</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <a href="{{ route('admin.languages.index') }}" class="btn btn-secondary m-btn m-btn--icon m-btn--wide m-btn--md m--margin-right-10">
                        <span>
                            <i class="la la-arrow-left"></i>
                            <span>Back</span>
                        </span>
                    </a>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-brand m-btn m-btn--icon m-btn--wide m-btn--md">
                            <span>
                                <i class="la la-check"></i>
                                <span>Save</span>
                            </span>
                        </button>
                        <button type="button" class="btn btn-brand dropdown-toggle dropdown-toggle-split m-btn m-btn--md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                            <a class="dropdown-item" href="#"><i class="la la-plus"></i> Save &amp; New</a>
                            <a class="dropdown-item" href="#"><i class="la la-copy"></i> Save &amp; Duplicate</a>
                            <button type="submit" class="btn dropdown-item"><i class="la la-undo"></i> Save &amp; Close</button>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="la la-close"></i> Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!-- begin: Form -->
            {{-- form($form) --}}
            {!! form_rest($form) !!}
            <!-- end: Form -->
        </div>
    </div>
    <!-- end: Portlet -->
    {!! form_end($form, false) !!}
@stop
