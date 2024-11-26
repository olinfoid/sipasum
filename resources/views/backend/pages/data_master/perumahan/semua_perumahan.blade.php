@extends('backend.layouts.app')
@push('be-meta-seo')
    <title>SIPASUM - Semua Perumahan</title>
    <meta content="Halaman Perumahan" name="description">
    <meta content="Ilman Hilmi Oriza, S.T" name="author">
    <meta content="Sistem Informasi Prasarana Sarana dan Utilitas Umum" name="keywords">
@endpush
@push('be-custom-css')
    <!-- Custom CSS -->
    <link rel="stylesheet"
        href="{{ asset('public/assets/be/libs/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/be/libs/selectpicker/bootstrap-select.min.css') }}">
    
@endpush
@section('be.konten')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Breadcrum -->
    <div class="mb-3">
        <h4 class="mb-1">Semua Perumahan</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Data</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('be.masterdata.perumahan.semua_perumahan') }}">Semua Perumahan</a>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header mb-4 p-2" style="background-color:rgb(64 125 221 / 31%);">
            <div class="row">
                <div class="col-lg-6" style="padding-left:30px;">
                    <a href="{{ route('be.masterdata.perumahan.tambah_perumahan')}}" type="button" class="btn btn-primary">
                        <span class="tf-icons bx bx-plus-circle"></span> Perumahan
                    </a>       
                </div>
                <div class="col-lg-6">
                                    
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive text-nowrap mb-4">
                <table class="table table-striped" id="tbl_permohonan">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-center">No</th>
                            <th class="text-start">Perumahan</th>
                            <th class="text-start">Pengembang</th>
                            <th class="text-start">Siteplan</th>
                            <th class="text-center">Status PSU</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($perumahan as $key => $val_data)
                        @php 
                            $id_pengembang        = $val_data->id_pengembang;
                            $nm_perusahaan        = $val_data->nm_perusahaan;
                            $alamat_perusahaan    = $val_data->alamat_perusahaan;
                            $id_users             = $val_data->id_users;
                            $nm_user              = $val_data->nm_user;
                            $id_perumahan         = $val_data->id_perumahan;
                            $nm_perumahan         = $val_data->nm_perumahan;
                            $luas_lahan_perumahan = $val_data->luas_lahan_perumahan;
                            $jml_unit             = $val_data->jml_unit;
                            $nm_kecamatan         = $val_data->nm_kecamatan;
                            $nm_desa              = $val_data->nm_desa;
                            $status_permohonan    = $val_data->status_permohonan;


                            $edit_data  = "'".base64_encode($id_perumahan)."'";
                            $hapus_data = "'".$id_perumahan."'";
                        @endphp
                        <tr>
                            <th class="text-center" scope="row">{{$key+1}}</th>
                            <td><b>{{$nm_perumahan}}</b></br>
                                {{'Desa : '.ucfirst(strtolower($nm_desa))}} </br> 
                                {{'Kecamatan : '.ucfirst(strtolower($nm_kecamatan))}} 
                            </td>
                            <td><b>{{$nm_perusahaan}}</b></br>
                                {{'Pemilik : '.ucfirst(strtolower($nm_user))}} </br>
                                {{'Alamat : '.ucfirst(strtolower($alamat_perusahaan))}}
                            </td>
                            <td>
                                <b>Perumahan</b> </br>
                                {{'Luas : '.$luas_lahan_perumahan. ' ㎡'}} </br>
                                {{'Unit : '.$jml_unit}}
                            </td>
                            <td class="text-center text-capitalize">{{$status_permohonan == 'serah_terima_psu' ? 'Sudah Serah Terima PSU' : 'Belum Serah Terima PSU'}}</td>
                            <td class="text-center">
                                <div class="btn-group-sm" role="group" aria-label="First group">
                                    <button type="button" onclick="edit_data( {{$edit_data}} )"
                                        class="btn btn-secondary">
                                        <i class="tf-icons bx bx-edit-alt"></i>
                                    </button>
                                    <button type="button" onclick="hapus_data( {{$hapus_data}} )"
                                        class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus_data">
                                        <i class="tf-icons bx bx-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Responsive Table -->

    <!-- Delete Modal -->
    <div class="modal fade" id="hapus_data" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lbl-hapus_data"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('be.masterdata.perumahan.act_hapus_perumahan')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="hps-id_perumahan" name="id_perumahan"/>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <h4 class="mb-2">Yakin Hapus Data?</h4>
                            <p>data yang telah dihapus
                            tidak bisa dikembalikan!</p>
                        </div>
                    </div>
                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Yakin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('backend.pages.toast')
</div>
@endsection
@push('be-js')
{!! Toastr::message() !!}
<!-- Vendors JS -->
<script src="{{ asset('public/assets/be/libs/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/assets/be/libs/datatables/language/indonesia.js') }}"></script>
<script src="{{ asset('public/assets/be/libs/selectpicker/bootstrap-select.min.js') }}"></script>

<script type="text/javascript">
    function edit_data(id){
        var url = "{{route('be.masterdata.perumahan.edit_perumahan')}}"+"/"+id;
        window.location.assign(url);
    }
    function hapus_data(id){
        $('#hps-id_perumahan').val(id);
    }
    $('#tbl_permohonan').DataTable({
        "language": indonesia
    });
</script>

@endpush
