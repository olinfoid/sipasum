<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.layouts.app_head')
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    @include('frontend.layouts.app_navbar')
    <!-- Navbar End -->

    <div>
        @yield('konten')
    </div>

    <!-- Footer Start -->
    @include('frontend.layouts.app_footer')
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

    @include('frontend.layouts.app_script')
    
</body>
</html>