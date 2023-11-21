<div class="input-group-append">
    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $options['attr']['data-lang-libelle']; ?></button>
    <div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-175px py-4">
        @foreach (session()->get('languages') as $language)
        <div class="menu-item px-3">
            <a class="menu-link px-3 lang-change" href="#" data-lang="{{ $language->alpha2 }}">
                <span class="symbol symbol-20px me-4">
                    <img class="rounded-1" src="{{ $language->flag }}" alt="" />
                </span>
                {{ $language->name }}
            </a>
        </div>
        @endforeach
    </div>
</div>
