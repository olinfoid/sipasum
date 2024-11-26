@extends('backend.layouts.app_auth')
@push('be-meta-seo')
    <title>SIPASUM - Login</title>
    <meta content="Halaman Login" name="description">
    <meta content="Ilman Hilmi Oriza, S.T" name="author">
    <meta content="Sistem Informasi Prasarana Sarana dan Utilitas Umum" name="keywords">
@endpush
@push('be-custom-css')
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('public/assets/be/css/pages/page-auth.css') }}" />
@endpush
@section('be.konten')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Sign-in  -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    <a href="index.html" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('public/assets/be/img/favicon/logo.png') }}" width="40"/>
                        </span>
                        <span class="app-brand-text demo text-body fw-bolder">SIPASUM</span>
                    </a>
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Selamat Datang! 👋</h4>
                <p class="mb-4">Silahkan Masuk ke Akun Anda.</p>

                <form id="formAuthentication" class="mb-3" action="{{ route('auth.act_login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="email" class="form-label">Username</label>
                        <input
                        type="text"
                        class="form-control"
                        id="username"
                        name="username"
                        placeholder="Masukan username anda"
                        autofocus
                        />
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                            <!-- <a href="#">
                                <small>Forgot Password?</small>
                            </a> -->
                        </div>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="Masukan password anda"
                                aria-describedby="password"
                            />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Sign-in -->
    </div>
</div>
@endsection
@push('be-js')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            toastr.error('{{ $error }}', 'Gagal');
        </script>
    @endforeach
@endif
{!! Toastr::message() !!}
@endpush