@extends('layouts.master')

@if (isset($role))
    @section('title_page', 'Edition du rôle')
    @section('breadcrumb')
        <span class="kt-subheader__separator kt-subheader__separator--v"></span>
        <div class="kt-subheader__breadcrumbs">
            <span class="kt-subheader__desc">{{ $role->name }}</span>
        </div>
    @stop
@else
    @section('title_page', 'Création d\'un nouveau rôle')
@endif

@section('subheader_toolbar')
<div class="kt-subheader__toolbar">
    <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-bold">Back</a>

    <div class="btn-group">
        <button type="button" href="#save_close" class="btn btn-brand btn-bold my-link__save">Save Changes</button>
        <button type="button" class="btn btn-brand btn-bold dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
            <ul class="kt-nav">
                <li class="kt-nav__item">
                    <a href="#save_stay" class="kt-nav__link my-link__save">
                        <i class="kt-nav__link-icon flaticon2-writing"></i>
                        <span class="kt-nav__link-text">Save &amp; Stay</span>
                    </a>
                </li>
                <li class="kt-nav__item">
                    <a href="#save_new" class="kt-nav__link my-link__save">
                        <i class="kt-nav__link-icon flaticon2-medical-records"></i>
                        <span class="kt-nav__link-text">Save &amp; New</span>
                    </a>
                </li>
                <li class="kt-nav__item">
                    <a href="#save_close" class="kt-nav__link my-link__save">
                        <i class="kt-nav__link-icon flaticon2-hourglass-1"></i>
                        <span class="kt-nav__link-text">Save &amp; Close</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@stop

@section('content_page')
    <!-- begin: Portlet -->
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('partials.flash')

            <!-- begin: Form -->
            {!! form_start($form) !!}
            {{-- form($form) --}}
            {!! form_rest($form) !!}

            <div class="d-none">
                <button type="submit" name="save" id="save_new" value="save_new">Save &amp; New</button>
                <button type="submit" name="save" id="save_stay" value="save_stay">Save &amp; Stay</button>
                <button type="submit" name="save" id="save_close" value="save_close">Save &amp; Close</button>
            </div>
            {!! form_end($form, false) !!}
            <!-- end: Form -->
        </div>
    </div>
    <!-- end: Portlet -->
@stop

@push('scripts')
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $('select[name="permission[]"]').bootstrapDualListbox({
                nonSelectedListLabel: 'Permissions disponibles',
                selectedListLabel: 'Permissions liées au rôle',
                moveOnSelect: false
            });
        });
    </script>
@endpush
