<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer">
        @foreach ($domain->languages as $domain_language)
        <tr>
            <td class="w-100">{{ $domain_language->language->name }}</td>
            <td>
                @php
                    $label_on = 'Actif';
                    $label_off = 'Inactif';
                    $class_btn = $domain_language->active == 'Y' ? 'btn-light-success' : 'btn-light-danger';
                    $class_i = $domain_language->active == 'Y' ? 'la-toggle-on' : 'la-toggle-off';
                @endphp
                <a href="javascript:;" data-url="{{ route('admin.domains_languages_active', ['domain_language' => $domain_language->id]) }}" data-label-on="{{ $label_on }}" data-label-off="{{ $label_off }}" class="toggle-active btn btn-sm min-w-100px {{ $class_btn }}"><i class="la {{ $class_i }}"></i>{{ $domain_language->active == 'Y' ? $label_on : $label_off }}</a>
            </td>
            <td>
                @php
                    $items = [];
                    $items['edit'] = ['link' => $domain_language->url_backend->edit, 'label' => 'Edit'];
                    $items['delete'] = ['link' => $domain_language->url_backend->destroy, 'label' => 'Delete'];
                @endphp
                @include('components.datatableactions', compact('items'))
            </td>
        </tr>
        @endforeach
    </table>
</div>
