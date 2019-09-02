<div id="m_aside_left" class="m-grid__item  m-aside-left m-aside-left--skin-dark">
    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark" m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow">
            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="{{ route('admin.dashboard') }}" class="m-menu__link">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">Dashboard</span>
                            <span class="m-menu__link-badge">
                                <span class="m-badge m-badge--danger">2</span>
                            </span>
                        </span>
                    </span>
                </a>
            </li>

            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-cogwheel-2"></i>
                    <span class="m-menu__link-text">Configuration</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">Configuration</span>
                            </span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.domains.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Domaines</span>
                            </a>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.languages.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Langues</span>
                            </a>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.menus.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Menus</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-text">Utilisateurs</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">Utilisateurs</span>
                            </span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.users.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Utilisateurs</span>
                            </a>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.roles.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Rôles</span>
                            </a>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.permissions.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Permissions</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-bag"></i>
                    <span class="m-menu__link-text">Catalogue</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">Catalogue</span>
                            </span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.products.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Produits</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-cart"></i>
                    <span class="m-menu__link-text">E-commerce</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">E-commerce</span>
                            </span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="#" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Commandes</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-text">Contenus</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">Contenus</span>
                            </span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Actualités</span>
                            </a>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="javascript:;" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Carrousels</span>
                            </a>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.pages.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Pages</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-folder-1"></i>
                    <span class="m-menu__link-text">Formulaires</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">Formulaires</span>
                            </span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.formulaires.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Générateur</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                <a href="javascript:;" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-email"></i>
                    <span class="m-menu__link-text">E-mails</span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item m-menu__item--parent" aria-haspopup="true">
                            <span class="m-menu__link">
                                <span class="m-menu__link-text">E-mails</span>
                            </span>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="{{ route('admin.emails.index') }}" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Templates</span>
                            </a>
                        </li>
                        <li class="m-menu__item" aria-haspopup="true">
                            <a href="#" class="m-menu__link">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Newsletters</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
