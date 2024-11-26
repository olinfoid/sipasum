<!DOCTYPE html>
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
>
  <head>
    @include('backend.layouts.app_head')
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
        @yield('be.konten')
    </div>
    <!-- / Content -->

    <!-- Tombol Melayang Kanan Bawah -->
    <!-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> -->

    @include('backend.layouts.app_script')
  </body>
</html>
