@extends('backend.layouts.app')
@push('be-meta-seo')
    <title>SIPASUM - Semua Pengembang</title>
    <meta content="Halaman Pengembang" name="description">
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
        <h4 class="mb-1">Semua Pengembang</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Data</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('be.psu.permohonan.index') }}">Semua Pengembang</a>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header mb-4 p-2" style="background-color:rgb(64 125 221 / 31%);">
            <div class="row">
                <div class="col-lg-6" style="padding-left:30px;">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah_data">
                        <span class="tf-icons bx bx-plus-circle"></span> Perusahaan
                    </button>         
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
                            <th class="text-start">Nama Perusahaan</th>
                            <th class="text-start">Pemilik</th>
                            <th class="text-center">No Telepon</th>
                            <th class="text-start">Alamat</th>
                            <th class="text-center">Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengembang as $key => $val_data)
                        @php 
                            $id                = $val_data->id;
                            $id_user           = $val_data->id_users;
                            $nm_perusahaan     = $val_data->nm_perusahaan;
                            $no_tlp_perusahaan = $val_data->no_tlp_perusahaan;
                            $alamat_perusahaan = $val_data->alamat_perusahaan;
                            $nm_pemilik        = $val_data->nm_user;
                            $status_akun       = $val_data->status_akun;

                            $id_pengembang     = "'".$id."'";
                            $id_users          = "'".$id_user."'";
                            $nama_perusahaan   = "'".$nm_perusahaan."'";
                            $nama_pemilik      = "'".$nm_pemilik."'";
                            $no_perusahaan     = "'".$no_tlp_perusahaan."'";
                            $alamat_usaha      = "'".$alamat_perusahaan."'";
                            $status_pengembang = "'".$status_akun."'";

                            $edit_data = $id_pengembang.','.$id_users.','.$nama_perusahaan.','.$nama_pemilik.','.$no_perusahaan.
                                ','.$alamat_usaha.','.$status_pengembang;
                            $hapus_data = $id_pengembang;
                        @endphp
                        <tr>
                            <th class="text-center" scope="row">{{$key+1}}</th>
                            <td>{{$nm_perusahaan}}</td>
                            <td>{{$nm_pemilik}}</td>
                            <td class="text-center text-capitalize">{{$no_tlp_perusahaan}}</td>
                            <td class="text-start">{{$alamat_perusahaan}}</td>
                            <td class="text-center text-capitalize">{{$status_akun == 'aktif' ? 'Aktif' : 'Tidak Aktif'}}</td>
                            <td class="text-center">
                                <div class="btn-group-sm" role="group" aria-label="First group">
                                    <button type="button" onclick="edit_data( {{$edit_data}} )"
                                        class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#edit_data">
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

    <!-- Tambah Modal -->
    <div class="modal fade" id="tambah_data" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lbl-tambah_data">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('be.masterdata.pengembang.act_tambah_pengembang')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="add-pemilik_perusahaan" class="form-label">Pemilik Perusahaan</label>
                            <select id="add-pemilik_perusahaan" name="pemilik_perusahaan" class="form-control selectpicker" data-live-search="true" data-size="7">
                                <option value="0" selected>== Pilih Pemilik ==</option>
                                @foreach($users as $val_users)
                                    <option value="{{$val_users->id}}" @selected(old('pemilik_perusahaan') == $val_users->id)>{{$val_users->nm_user.' ('.$val_users->no_tlp.')'}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add-nm_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="add-nm_perusahaan" name="nm_perusahaan" placeholder="Masukan Nama Perusahaan" value="{{ old('nm_perusahaan') }}"/>
                        </div>
                        <div class="mb-3">
                            <label for="add-no_tlp_perusahaan" class="form-label">No Tlp Perusahaan</label>
                            <input type="number" class="form-control" id="add-no_tlp_perusahaan" name="no_tlp_perusahaan" placeholder="Masukan No Telepon Perusahaan" value="{{ old('no_tlp_perusahaan') }}"
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div>
                            <label for="add-alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                            <textarea class="form-control" id="add-alamat_perusahaan" name="alamat_perusahaan" rows="3" placeholder="Masukan Alamat Perusahaan">{{ old('alamat_perusahaan') }}</textarea>
                        </div>
                    </div>
                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="edit_data" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lbl-edit_data">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('be.masterdata.pengembang.act_edit_pengembang')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="edt-id_pengembang" name="id_pengembang"/>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edt-nm_perusahaan" class="form-label">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="edt-nm_perusahaan" name="nm_perusahaan" placeholder="Masukan Nama Perusahaan" />
                        </div>
                        <div class="mb-3">
                            <label for="edt-no_tlp_perusahaan" class="form-label">No Tlp Perusahaan</label>
                            <input type="number" class="form-control" id="edt-no_tlp_perusahaan" name="no_tlp_perusahaan" placeholder="Masukan No Telepon Perusahaan" 
                                pattern="/^-?\d+\.?\d*$/"
                                onKeyPress="if(this.value.length==15) return false;"/>
                        </div>
                        <div>
                            <label for="edt-alamat_perusahaan" class="form-label">Alamat Perusahaan</label>
                            <textarea class="form-control" id="edt-alamat_perusahaan" name="alamat_perusahaan" rows="3" placeholder="Masukan Alamat Perusahaan"></textarea>
                        </div>
                    </div>
                    <div class="text-center mb-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="hapus_data" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lbl-hapus_data"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('be.masterdata.pengembang.act_hapus_pengembang')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="hps-id_pengembang" name="id_pengembang"/>
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

    $('#tbl_permohonan').DataTable({
        "language": indonesia
    });
</script>
<script type="text/javascript">
    function edit_data(id,id_users,nama_perusahaan,nama_pemilik,no_perusahaan,alamat_usaha,status_pengembang){
        $('#edt-id_pengembang').val(id);
        $('#edt-nm_perusahaan').val(nama_perusahaan);
        $('#edt-no_tlp_perusahaan').val(no_perusahaan);
        $('#edt-alamat_perusahaan').val(alamat_usaha);
    }
    function hapus_data(id){
        $('#hps-id_pengembang').val(id);
    }
</script>
@endpush