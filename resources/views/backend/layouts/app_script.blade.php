<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset('public/assets/be/libs/jquery/jquery.js') }}"></script>
<script src="{{asset('public/assets/be/libs/popper/popper.js') }}"></script>
<script src="{{asset('public/assets/be/js/bootstrap.js') }}"></script>
<script src="{{asset('public/assets/be/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('public/assets/be/libs/toastr/toastr.min.js') }}" type="text/javascript"></script>

<script src="{{asset('public/assets/be/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Main JS -->
<script src="{{asset('public/assets/be/js/main.js') }}"></script>
<script async defer src="{{asset('public/assets/be/js/buttons.js') }}"></script>

<!-- Custom JS disini -->
@stack('be-js')