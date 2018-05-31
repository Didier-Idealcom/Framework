<!-- BEGIN: Topbar -->
<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
    <div class="m-stack__item m-topbar__nav-wrapper">
        <ul class="m-topbar__nav m-nav m-nav--inline">
            @include('partials.topbar-search-dropdown')
            @include('partials.topbar-notifications')
            @include('partials.topbar-quick-actions')
            @include('partials.topbar-user-profile')
            <li id="m_quick_sidebar_toggle" class="m-nav__item">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                    <span class="m-nav__link-icon">
                        <i class="flaticon-grid-menu"></i>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Topbar -->
