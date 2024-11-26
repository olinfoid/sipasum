@if ($errors->any())
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-50 start-50 translate-middle show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell bx-tada me-2"></i>
            <div class="me-auto fw-semibold">Maaf</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        @php 
            $no_msg = 0;
            $msg_error = array();
        @endphp
        @foreach ($errors->all() as $error)
            @php 
                $no_msg = $no_msg+1;
                $error_msg[] = $error;
            @endphp
        @endforeach

        @if($no_msg < 9)
            @foreach($error_msg as $err)
                <p>{{$err}}</p>
            @endforeach
        @else
            <p>Lihat Form berwarna merah ! </br>Mohon isi dengan data yang benar.</p>
        @endif
        </div>
    </div>
@elseif(\Session::has('success'))
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-success top-50 start-50 translate-middle show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell bx-tada me-2"></i>
            <div class="me-auto fw-semibold">Berhasil</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        {!! \Session::get('success') !!}
        </div>
    </div>
@elseif(\Session::has('failed'))
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-danger top-50 start-50 translate-middle show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell bx-tada me-2"></i>
            <div class="me-auto fw-semibold">Gagal</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        {!! \Session::get('failed') !!}
        </div>
    </div>
@endif