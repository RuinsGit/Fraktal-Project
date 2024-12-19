<header id="page-topbar" style="background: purple">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box" style="background: transparent;">
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('back/assets/images/logo.webp') }}" alt="logo-sm" height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('back/assets/images/logo.webp') }}" alt="logo-dark" height="50">
                    </span>
                </a>

                <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('back/assets/images/logo.webp') }}" alt="logo-sm-light"
                            height="25">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('back/assets/images/logo.webp') }}" alt="logo-light" height="50">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn" style="color: white;">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                    style="color: white; border-radius: 8px; padding: 8px 15px;">
                        <img width="35" class="rounded-circle" src="{{ asset('back/assets/images/logo.webp') }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" style="color: white;">{{ auth()->guard('admin')->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" style="border-radius: 8px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
