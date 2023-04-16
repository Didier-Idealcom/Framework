@if(Session::has('success'))
    @php
        $message = '<strong>SUCCÈS</strong><span>' . Session::get('success') . '</span>';
        $dismiss = true;
    @endphp
    <x-alert type="success" :message="$message" :dismiss="$dismiss" class="mb-10" />
@endif
