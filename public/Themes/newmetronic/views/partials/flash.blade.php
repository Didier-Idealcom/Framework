@if(Session::has('success'))
    <div class="alert flash alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>SUCCESS</strong> : {{ Session::get('success') }}
    </div>
@endif
