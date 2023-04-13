@if(Session::has('success'))
    @php
        $message = '<strong>SUCCÈS</strong><span>' . Session::get('success') . '</span>';
        $icon = 'duotone/General/Shield-check';
        $dismiss = true;
    @endphp
    <x-alert type="success" :message="$message" :icon="$icon" :dismiss="$dismiss" class="mb-10" />
@endif
