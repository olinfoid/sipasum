<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">Jl. Raya Mangunreja-Sukaraja Km. 1.200</a></small>
                <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">dputrprkplh@tasikmalayakab.go.id</a></small>
            </div>
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
        <a href="" class="navbar-brand">
            <img src="{{ asset('public/assets/fe/img/icons/logo_kab_tasik.png') }}" alt="Logo" class="logo" style="height: 50px; width: 50 px;">
            <img src="{{ asset('public/assets/fe/img/icons/logo.png') }}" alt="Logo" class="logo" style="height: 50px; width: 50 px;">
        </a>
        <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars text-primary"></span>
        </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('index')}}" class="nav-item nav-link {{ Route::currentRouteNamed('index') ? 'active' : '' }}">Beranda</a>
                    <!-- <a href="" class="nav-item nav-link">Berita</a> -->
                    <a href="{{ route('fe.list_perumahan')}}" class="nav-item nav-link {{ Route::currentRouteNamed('fe.list_perumahan') ? 'active' : '' }}">Daftar Perumahan</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Serah Terima PSU</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <li><a href="{{asset('public/storage/hukum/panduan.pdf')}}" class="dropdown-item" target="_blank">Panduan</a></li>
                            <li><a href="{{asset('public/storage/hukum/format_dan_persyaratan.pdf')}}" class="dropdown-item" target="_blank">Format dan Persyaratan</a></li>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Tentang Hukum</a>
                        <div class="dropdown-menu m-0 bg-secondary rounded-0">
                            <li><a href="{{asset('public/storage/hukum/undang_undang.pdf')}}" class="dropdown-item" target="_blank">Undang-Undang</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="{{asset('public/storage/hukum/no14tahun2016.pdf')}}" class="dropdown-item" target="_blank" class="dropdown-item">PP No 14 Tahun 2016</a></li>
                            <li><a href="{{asset('public/storage/hukum/no64tahun2016.pdf')}}" class="dropdown-item" target="_blank" class="dropdown-item">PP No 64 Tahun 2016</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="{{asset('public/storage/hukum/peraturan_menteri.pdf')}}" class="dropdown-item" target="_blank" class="dropdown-item">Peraturan Menteri</a></li>
                            <li><a href="{{asset('public/storage/hukum/peraturan_daerah.pdf')}}" class="dropdown-item" target="_blank" class="dropdown-item">Peraturan Bupati</a></li>
                        </div>
                    </div>
                    <a href="{{ route('fe.tentang')}}" class="nav-item nav-link {{ Route::currentRouteNamed('fe.tentang') ? 'active' : '' }}">Tentang</a>
                </div>
                    <a href="{{route('auth.login')}}" class="my-auto"><i class="fas fa-right-to-bracket fa-2x"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>