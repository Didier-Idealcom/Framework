@extends('layouts.master')

@section('title_page', 'Gestion des rôles')

@section('breadcrumb')
    @php
        $items = [];
        $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
        $items[] = ['link' => route('admin.users.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Utilisateurs'];
        $items[] = ['link' => route('admin.roles.index'), 'class' => 'text-dark', 'label' => 'Rôles'];
    @endphp
    <x-breadcrumb :items="$items" />
@endsection

@section('subheader_toolbar')
    <x-addbutton url="{{ route('admin.roles.create') }}" />
@endsection

@section('content_page')
    {{-- @php
        $id = 'kt_table_roles';
        $search = true;
        $filter = false;
        $import = 'javascript:;';
        $export = 'javascript:;';
    @endphp
    <x-datatable :id="$id" :search="$search" :filter="$filter" :import="$import" :export="$export" /> --}}

    @include('partials.flash')

    @if (!empty($roles))
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-9">
        @foreach ($roles as $role)
        <!--begin::Col-->
        <div class="col-md-4">
            <!--begin::Card-->
            <div class="card card-flush h-md-100">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>{{ $role->name }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-1">
                    <!--begin::Users-->
                    <div class="fw-bolder text-gray-600 mb-5">Utilisateurs associés à ce rôle : {{ count($role->users) }}</div>
                    <!--end::Users-->

                    @if (!empty($role->permissions))
                    <!--begin::Permissions-->
                    <div class="d-flex flex-column text-gray-600">
                        @foreach ($role->permissions as $key => $permission)
                        <div class="d-flex align-items-center py-2">
                            <span class="bullet bg-primary me-3"></span>{{ $permission->name }}
                        </div>
                        @if ($key == 2)
                            @break
                        @endif
                        @endforeach
                        <div class="d-flex align-items-center py-2">
                            <span class="bullet bg-primary me-3"></span>
                            <em>Total : {{ count($role->permissions) }}</em>
                        </div>
                    </div>
                    <!--end::Permissions-->
                    @endif
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer flex-wrap pt-0">
                    <a href="{{ $role->url_backend->edit }}" class="btn btn-light-primary my-1 me-2">Editer</a>
                    <form action="{{ $role->url_backend->destroy }}" method="POST" class="form-delete d-inline-flex">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <button class="btn btn-light-danger">Delete</button>
                    </form>
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->
        @endforeach
    </div>
    @endif
@endsection

@push('scripts')
    <!--begin::Page Snippets -->
    <script type="text/javascript">
        // On document ready
        /*KTUtil.onDOMContentLoaded(function() {
            var target = '#kt_table_roles';
            var url = '{!! route('admin.roles_datatable') !!}';
            var columns = [{
                data: 'record_id',
                name: 'record_id',
                title: '#',
                width: 30,
                textAlign: 'center'
            }, {
                data: 'id',
                name: 'id',
                title: 'ID',
                width: 50,
                visible: false,
                textAlign: 'center'
            }, {
                data: 'name',
                name: 'name',
                title: 'Nom'
            }, {
                data: 'guard_name',
                name: 'guard_name',
                title: 'Guard'
            }, {
                data: 'created_at',
                name: 'created_at',
                title: 'Création',
                type: 'date',
                format: 'DD/MM/YYYY'
            }, {
                data: 'actions',
                name: 'actions',
                title: 'Actions',
                width: 80,
                orderable: false
            }];

            MyListDatatable.init(target, url, columns);
        });*/
    </script>
    <!--end::Page Snippets -->
@endpush
