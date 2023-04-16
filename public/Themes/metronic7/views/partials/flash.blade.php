@if(Session::has('success'))
    <div class="alert flash alert-success fade show" role="alert">
        <div class="alert-text">
            <strong>SUCCESS</strong> : {{ Session::get('success') }}
        </div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif
