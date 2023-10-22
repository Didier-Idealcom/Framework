@extends('layouts.master')

@if (isset($menu))
    @section('title_page', 'Gestion des menus : Edition')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.menus.index'), 'class' => 'text-muted text-hover-primary', 'label' => 'Menus'];
            $items[] = ['link' => $menu->url_backend->edit, 'class' => 'text-dark', 'label' => $menu->title];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@else
    @section('title_page', 'Gestion des menus : Création')

    @section('breadcrumb')
        @php
            $items = [];
            $items[] = ['link' => route('admin.dashboard'), 'class' => 'text-muted text-hover-primary', 'label' => 'Dashboard'];
            $items[] = ['link' => route('admin.menus.index'), 'class' => 'text-dark', 'label' => 'Menus'];
        @endphp
        <x-breadcrumb :items="$items" />
    @endsection
@endif

@section('subheader_toolbar')
    <x-backbutton url="{{ route('admin.menus.index') }}" />

    @include('partials.dropdown_save')
@endsection

@section('content_page')
    {{-- @if (isset($menu))
        @php
            $items = [];
            $items[] = ['link' => 'javascript:;', 'label' => 'Fiche détail', 'active' => true];
            $items[] = ['link' => route('admin.menuitems.index', $menu->id), 'label' => 'Menuitems', 'active' => false];
        @endphp
        <x-tabs :items="$items" />
    @endif --}}

    <x-form :form="$form" />

    @if (!empty($menuitems))
    @php($count = count($menuitems))
    <div class="dd nestable">
        <ol class="dd-list">
            @foreach ($menuitems as $key => $menuitem)
            @php($next = $menuitems->get($key+1))
            <li class="dd-item" data-id="{{ $menuitem->id }}">
                <div class="dd-handle">Drag</div>
                <div class="dd-content">
                    {{ $menuitem->title_menu }}
                    <div class="dd-content-more">
                        <p>{{ 'Gabarit : ' . $menuitem->gabarit }}</p>
                        <p>{{ 'Target : ' . $menuitem->target }}</p>
                        <p>{{ 'Visible : ' . $menuitem->visible }}</p>
                        <p>{{ 'Cliquable : ' . $menuitem->cliquable }}</p>
                    </div>
                </div>
                @if (($menuitem->bd - $menuitem->bg) > 1 && $next && $next->niveau > $menuitem->niveau)
                <ol class="dd-list">
                @else
            </li>
                @endif

                @php($diff = $next ? $menuitem->niveau - $next->niveau : $menuitem->niveau - 1)
                @if ($diff > 0 && $key < $count)
                @for ($i = 0; $i < $diff; $i++)
                    </ol>
                </li>
                @endfor
                @endif
            @endforeach
        </ol>
    </div>
    @endif
@endsection

@push('styles')
    <!--begin::Page Styles -->
    <style type="text/css">
        .dd-collapse,
        .dd-expand {
            display: none;
        }

        .dd-content-more p {
            margin-bottom: 0;
        }
    </style>
    <!--end::Page Styles -->
@endpush

@push('scripts')
    <!--begin::Page Snippets -->
    <script type="text/javascript">
        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            $('.nestable').nestable({
                callback: function() {
                    $('input[name="menuitems_data"]').val(JSON.stringify($('.nestable').nestable('toArray')));
                }
            });
        });
    </script>
    <!--end::Page Snippets -->
@endpush
