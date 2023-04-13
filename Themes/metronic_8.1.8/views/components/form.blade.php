<!--begin::Card-->
<div class="card card-custom">
    <!--begin::Card body-->
    <div class="card-body">
        @include('partials.flash')

        <!-- begin: Form -->
        {!! form_start($form) !!}
        {{-- form($form) --}}
        {!! form_rest($form) !!}

        @if (isset($submit) && $submit === true)
        <div>
            <button type="submit" name="save" value="save_stay" class="btn btn-sm btn-primary">Save</button>
        </div>
        @else
        <div class="d-none">
            <button type="submit" name="save" id="save_close" value="save_close">Save &amp; Close</button>
            <button type="submit" name="save" id="save_stay" value="save_stay">Save &amp; Stay</button>
            <button type="submit" name="save" id="save_new" value="save_new">Save &amp; New</button>
        </div>
        @endif
        {!! form_end($form, false) !!}
        <!-- end: Form -->
    </div>
    <!--end::Card body-->
</div>
<!-- end::Card -->
