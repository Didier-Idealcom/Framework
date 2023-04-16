<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div id="kt_aside_logo" class="aside-logo flex-column-auto">
        <!--begin::Logo-->
        <a href="{{ route('admin.dashboard') }}">
            <img class="h-15px logo" src="{{ theme_url('media/logos/logo-1.svg') }}" alt="Logo" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-double-left.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                {!! purifySvg(svg('duotone/Navigation/Angle-double-left')) !!}
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <!--begin::Svg Icon | path:assets/media/icons/duotone/Home/Home.svg-->
                                {!! purifySvg(svg('duotone/Home/Home')) !!}
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <!--begin::Svg Icon | path:assets/media/icons/duotone/General/Settings-2.svg-->
                                {!! purifySvg(svg('duotone/General/Settings-2')) !!}
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-title">Configuration</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a href="{{ route('admin.domains.index') }}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Domaines</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('admin.languages.index') }}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Langues</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('admin.menus.index') }}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Menus</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <!--begin::Svg Icon | path:assets/media/icons/duotone/General/User.svg-->
                                {!! purifySvg(svg('duotone/General/User')) !!}
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-title">Utilisateurs</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a href="{{ route('admin.users.index') }}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Utilisateurs</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Rôles</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Permissions</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <!--begin::Svg Icon | path:assets/media/icons/duotone/Shopping/Bag1.svg-->
                                {!! purifySvg(svg('duotone/Shopping/Bag1')) !!}
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-title">Catalogue</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a href="javascript:;" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Produits</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <!--begin::Svg Icon | path:assets/media/icons/duotone/Shopping/Cart2.svg-->
                                {!! purifySvg(svg('duotone/Shopping/Cart2')) !!}
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-title">E-commerce</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a href="javascript:;" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Commandes</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <!--begin::Svg Icon | path:assets/media/icons/duotone/Files/Selected-file.svg-->
                                {!! purifySvg(svg('duotone/Files/Selected-file')) !!}
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-title">Contenus</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a href="javascript:;" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Actualités</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="javascript:;" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Carrousels</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('admin.pages.index') }}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Pages</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <!--begin::Svg Icon | path:assets/media/icons/duotone/Files/Group-folders.svg-->
                                {!! purifySvg(svg('duotone/Files/Group-folders')) !!}
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-title">Formulaires</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a href="{{ route('admin.formulaires.index') }}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Générateur</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <!--begin::Svg Icon | path:assets/media/icons/duotone/Communication/Mail.svg-->
                                {!! purifySvg(svg('duotone/Communication/Mail')) !!}
                                <!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-title">E-mails</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                        <div class="menu-item">
                            <a href="{{ route('admin.emails.index') }}" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Templates</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="javascript:;" class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Newsletters</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
</div>
<!--end::Aside-->
