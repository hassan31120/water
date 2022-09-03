<body class="g-sidenav-show rtl bg-gray-200">
    <aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret  bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
                target="_blank">

                <img src="{{ asset('admin/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="me-1 font-weight-bold text-white">Material Dashboard 2</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div class="collapse navbar-collapse px-0 w-auto  max-height-vh-100" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() ==  'admin/users' ? 'active' : ''  }}" href="{{ route('admin.users') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">format_textdirection_r_to_l</i>
                        </div>
                        <span class="nav-link-text me-1">الأعضاء</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() ==  'admin/addresses' ? 'active' : ''  }}" href="{{ route('admin.addresses') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">format_textdirection_r_to_l</i>
                        </div>
                        <span class="nav-link-text me-1">العناوين</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() ==  'admin/news' ? 'active' : ''  }}" href="{{ route('admin.news') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">format_textdirection_r_to_l</i>
                        </div>
                        <span class="nav-link-text me-1">الأخبار</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() ==  'admin/banners' ? 'active' : ''  }}" href="{{ route('admin.banners') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">format_textdirection_r_to_l</i>
                        </div>
                        <span class="nav-link-text me-1">الصور</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::path() ==  'admin/categories' ? 'active' : ''  }}" href="{{ route('admin.categories') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">format_textdirection_r_to_l</i>
                        </div>
                        <span class="nav-link-text me-1">الشركات</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidenav-footer position-absolute w-100 bottom-0 ">
            <div class="mx-3">
                <a class="btn bg-gradient-primary mt-4 w-100"
                    href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree"
                    type="button">Upgrade to pro</a>
            </div>
        </div>
    </aside>
