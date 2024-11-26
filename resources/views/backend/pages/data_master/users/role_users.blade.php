@extends('backend.layouts.app')
@push('be-meta-seo')
    <title>SIPASUM - Role Users</title>
    <meta content="Halaman Role Users" name="description">
    <meta content="Ilman Hilmi Oriza, S.T" name="author">
    <meta content="Sistem Informasi Prasarana Sarana dan Utilitas Umum" name="keywords">
@endpush
@push('be-custom-css')
    <!-- Custom CSS -->
    <link rel="stylesheet"
        href="{{ asset('public/assets/be/libs/datatables/css/dataTables.bootstrap4.css') }}">
@endpush
@section('be.konten')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Breadcrum -->
    <div class="mb-3">
        <h4 class="mb-1">Role Pengguna</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Masterdata</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('be.masterdata.users.role_users') }}">Role Pengguna</a>
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
                        <span class="tf-icons bx bx-plus-circle"></span> Role
                    </button>                 
                </div>
                <div class="col-lg-6">
                                    
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive text-nowrap mb-4">
                <table class="table table-striped" id="tbl_role">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-center">No</th>
                            <th>Nama Role</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($role_users as $key => $val_data)
                        @php 
                            $id         = $val_data->id;
                            $nama_role  = $val_data->nm_role;
                            $keterangan = $val_data->keterangan;

                            $id_role = "'".$id."'";
                            $nm_role = "'".$nama_role."'";
                            $ket = "'".$keterangan."'";
                        @endphp
                        <tr>
                            <th class="text-center" scope="row">{{$key+1}}</th>
                            <td>{{$nama_role}}</td>
                            <td>{{$keterangan}}</td>
                            <td class="text-center">
                                <div class="btn-group-sm" role="group" aria-label="First group">
                                    <button type="button" onclick="edit_data( {{$id_role.','.$nm_role.','.$ket}} )"
                                        class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#edit_data">
                                        <i class="tf-icons bx bx-edit-alt"></i>
                                    </button>
                                    <button type="button" onclick="hapus_data( {{$id_role}} )"
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
                <form action="{{route('be.masterdata.users.act_tambah_role_users')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="edt-nm_role" class="form-label">Nama Role</label>
                            <input type="text" class="form-control" id="add-nm_role" name="nm_role" placeholder="Masukan Nama Role" value="{{ old('nm_role') }}"/>
                        </div>
                        <div>
                            <label for="edt-keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="add-keterangan" name="keterangan" placeholder="Masukan Keterangan Role" rows="3">{{ old('keterangan') }}</textarea>
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
                <form action="{{route('be.masterdata.users.act_edit_role_users')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="edt-id_role" name="id_role"/>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label for="edt-nm_role" class="form-label">Nama Role</label>
                            <input type="text" class="form-control" id="edt-nm_role" name="nm_role" placeholder="Masukan Nama Role" aria-describedby="hlp-nm_role" />
                        </div>
                        <div>
                            <label for="edt-keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="edt-keterangan" name="keterangan" rows="3"></textarea>
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
                <form action="{{route('be.masterdata.users.act_hapus_role_users')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="hps-id_role" name="id_role"/>
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

<script type="text/javascript">

    // const EachWord = str => str.replace(/(^\w|\s\w)(\S*)/g, (_,m1,m2) => m1.toUpperCase()+m2.toLowerCase())

    $('#tbl_role').DataTable({
        "language": indonesia
    });
</script>
<script type="text/javascript">
    function edit_data(id,nm_role,ket){
        $('#edt-id_role').val(id);
        $('#edt-nm_role').val(nm_role);
        $('#edt-keterangan').val(ket);
    }
    function hapus_data(id){
        $('#hps-id_role').val(id);
    }
</script>
@endpush

