<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('public/assets/be/img/favicon/logo.png') }}" width="30"/>
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">SIPASUM</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Beranda -->
        <li class="menu-item {{Route::currentRouteNamed('be.beranda') ? 'active' : ''}}">
            <a href="{{route('be.beranda')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Beranda</div>
            </a>
        </li>

        <!-- Data PSU -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">PSU Data</span>
        </li>
        <li class="menu-item {{ (
                Route::currentRouteNamed('be.psu.permohonan.index_tambah_permohonan') || 
                Route::currentRouteNamed('be.psu.permohonan.index')
                ) ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class='menu-icon tf-icons bx bx-building-house'></i>
                <div data-i18n="Data PSU">Data PSU</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Route::currentRouteNamed('be.psu.permohonan.index_tambah_permohonan') ? 'active' : ''}}">
                    <a href="{{route('be.psu.permohonan.index_tambah_permohonan')}}" class="menu-link">
                        <div data-i18n="Tambah Permohonan">Tambah Permohonan</div>
                    </a>
                </li>
                <li class="menu-item {{ Route::currentRouteNamed('be.psu.permohonan.index') ? 'active' : ''}}">
                    <a href="{{route('be.psu.permohonan.index')}}" class="menu-link">
                        <div data-i18n="Data Permohonan PSU">Data Permohonan PSU</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>
        
        <li class="menu-item {{Route::currentRouteNamed('be.masterdata.pengembang.semua_pengembang') ? 'active' : ''}}">
            <a href="{{route('be.masterdata.pengembang.semua_pengembang')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-id-card"></i>
                <div data-i18n="Data Pengembang">Data Pengembang</div>
            </a>
        </li>
        <li class="menu-item {{Route::currentRouteNamed('be.masterdata.perumahan.semua_perumahan') ? 'active' : ''}}">
            <a href="{{route('be.masterdata.perumahan.semua_perumahan')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-business"></i>
                <div data-i18n="Data Perumahan">Data Perumahan</div>
            </a>
        </li>
        @if(Session::get('users_session')['nm_role'] == 'superadmin')
        <li class="menu-item {{ (
            Route::currentRouteNamed('be.masterdata.users.role_users') || 
            Route::currentRouteNamed('be.masterdata.users.semua_users')) ? 'active open' : ''
            }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Data Pengguna">Data Pengguna</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{Route::currentRouteNamed('be.masterdata.users.semua_users') ? 'active' : ''}}">
                    <a href="{{route('be.masterdata.users.semua_users')}}" class="menu-link">
                        <div data-i18n="Semua Pengguna">Semua Pengguna</div>
                    </a>
                </li>
                <li class="menu-item {{Route::currentRouteNamed('be.masterdata.users.role_users') ? 'active' : ''}}">
                    <a href="{{route('be.masterdata.users.role_users')}}" class="menu-link">
                        <div data-i18n="Role Pengguna">Role Pengguna</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</aside>