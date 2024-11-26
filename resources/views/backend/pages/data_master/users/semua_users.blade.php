@extends('backend.layouts.app')
@push('be-meta-seo')
    <title>SIPASUM - Semua Users</title>
    <meta content="Halaman Semua Users" name="description">
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
        <h4 class="mb-1">Semua Pengguna</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Masterdata</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('be.masterdata.users.semua_users') }}">Semua Pengguna</a>
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
                        <span class="tf-icons bx bx-plus-circle"></span> Pengguna
                    </button>                 
                </div>
                <div class="col-lg-6">
                                    
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive text-nowrap mb-4">
                <table class="table table-striped" id="tbl_user">
                    <thead>
                        <tr class="text-nowrap">
                            <th class="text-center">No</th>
                            <th class="text-start">Nama</th>
                            <th class="text-start">Telepon</th>
                            <th class="text-start">Alamat</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $val_data)
                        @php 
                            $id            = $val_data->id;
                            $nama_user     = $val_data->nm_user;
                            $no_telepon    = $val_data->no_tlp;
                            $alamat_usr    = $val_data->alamat;
                            $jenis_kelamin = $val_data->jns_kelamin;
                            $username_user = $val_data->username;
                            $password_user = $val_data->password;
                            $status_user   = $val_data->status_akun;
                            $role_user     = $val_data->id_role;
                            $nm_role       = $val_data->nm_role;

                            $id_user     = "'".$id."'";
                            $nm_user     = "'".$nama_user."'";
                            $no_tlp      = "'".$no_telepon."'";
                            $alamat      = "'".$alamat_usr."'";
                            $jns_kelamin = "'".$jenis_kelamin."'";
                            $username    = "'".$username_user."'";
                            $password    = "'".$password_user."'";
                            $status_akun = "'".$status_user."'";
                            $id_role     = "'".$role_user."'";

                            $edit_data = $id_user.','.$nm_user.','.$no_tlp.','.$alamat.','.$jns_kelamin.
                                ','.$username.','.$password.','.$status_akun.','.$id_role;
                        @endphp
                        <tr>
                            <th class="text-center" scope="row">{{$key+1}}</th>
                            <td>{{$nama_user}}</td>
                            <td>{{$no_telepon}}</td>
                            <td>{{$alamat_usr}}</td>
                            <td class="text-center text-capitalize">{{$jenis_kelamin}}</td>
                            <td class="text-center text-capitalize">{{$nm_role}}</td>
                            <td class="text-center text-capitalize">{{$status_user == 'aktif' ? 'Aktif' : 'Tidak Aktif'}}</td>
                            <td class="text-center">
                                <div class="btn-group-sm" role="group" aria-label="First group">
                                    <button type="button" onclick="edit_data( {{$edit_data}} )"
                                        class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#edit_data">
                                        <i class="tf-icons bx bx-edit-alt"></i>
                                    </button>
                                    <button type="button" onclick="hapus_data( {{$id_user}} )"
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
                    <h5 class="modal-title" id="lbl-tambah_data">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('be.masterdata.users.act_tambah_users')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-profil"
                                        aria-controls="navs-pills-justified-profil"
                                        aria-selected="true">
                                        <i class="tf-icons bx bx-user"></i> Profil
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#navs-pills-justified-auth"
                                        aria-controls="navs-pills-justified-auth"
                                        aria-selected="false">
                                        <i class="tf-icons bx bx-key"></i> Auth
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active p-0" id="navs-pills-justified-profil" role="tabpanel">
                                    <div class="mb-2">
                                        <label for="add-nm_user" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="add-nm_user" name="nm_user" placeholder="Masukan Nama Lengkap" value="{{old('nm_user')}}"/>
                                    </div>
                                    <div class="mb-2">
                                        <label for="add-no_telepon" class="form-label">No Telepon</label>
                                        <input type="number" class="form-control" id="add-no_telepon" name="no_telepon" placeholder="Masukan telepon" value="{{old('no_telepon')}}"
                                            pattern="/^-?\d+\.?\d*$/"
                                            onKeyPress="if(this.value.length==15) return false;"/>
                                    </div>
                                    <div class="mb-2">
                                        <label for="add-jns_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select id="add-jns_kelamin" name="jns_kelamin" class="form-control selectpicker">
                                            <option value="laki-laki" @selected(old('jns_kelamin') == 'laki-laki')>Laki-Laki</option>
                                            <option value="perempuan" @selected(old('jns_kelamin') == 'perempuan')>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="add-alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="add-alamat" name="alamat" rows="3">{{old('alamat')}}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-pills-justified-auth" role="tabpanel">
                                    <div class="mb-2">
                                        <label for="add-username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="add-username" name="username" placeholder="Masukan Username" value="{{old('username')}}"/>
                                    </div>
                                    <div class="mb-2 form-password-toggle">
                                        <label for="add-password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" id="add-password" name="password" placeholder="Masukan Password" aria-describedby="add-password" value="{{old('password')}}"/>
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="add-role_user" class="form-label">Role Pengguna</label>
                                        <select id="add-role_user" name="role_user" class="form-control selectpicker">
                                            @foreach($role_users as $val_role)
                                                <option value="{{$val_role->id}}" @selected(old('role_user') == $val_role->id)>{{$val_role->nm_role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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
                    <h5 class="modal-title" id="lbl-edit_data">Edit Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('be.masterdata.users.act_edit_users')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="edt-id_user" name="id_user"/>
                    <div class="modal-body">
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#edt-navs_profil"
                                        aria-controls="edt-navs_profil"
                                        aria-selected="true">
                                        <i class="tf-icons bx bx-user"></i> Profil
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#edt-navs_auth"
                                        aria-controls="edt-navs_auth"
                                        aria-selected="false">
                                        <i class="tf-icons bx bx-key"></i> Auth
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active p-0" id="edt-navs_profil" role="tabpanel">
                                    <div class="mb-2">
                                        <label for="edt-nm_user" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="edt-nm_user" name="nm_user" placeholder="Masukan Nama Lengkap" value="{{old('nm_user')}}"/>
                                    </div>
                                    <div class="mb-2">
                                        <label for="edt-no_telepon" class="form-label">No Telepon</label>
                                        <input type="number" class="form-control" id="edt-no_telepon" name="no_telepon" placeholder="Masukan telepon" value="{{old('no_telepon')}}"
                                            pattern="/^-?\d+\.?\d*$/"
                                            onKeyPress="if(this.value.length==15) return false;"/>
                                    </div>
                                    <div class="mb-2">
                                        <label for="edt-jns_kelamin" class="form-label">Jenis Kelamin</label>
                                        <select id="edt-jns_kelamin" name="jns_kelamin" class="form-control selectpicker">
                                            <option value="laki-laki" @selected(old('jns_kelamin') == 'laki-laki')>Laki-Laki</option>
                                            <option value="perempuan" @selected(old('jns_kelamin') == 'perempuan')>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="edt-alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="edt-alamat" name="alamat" rows="3">{{old('alamat')}}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="edt-navs_auth" role="tabpanel">
                                    <div class="mb-2">
                                        <label for="edt-username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="edt-username" name="username" placeholder="Masukan Username" value="{{old('username')}}"/>
                                    </div>
                                    <div class="mb-2 form-password-toggle">
                                        <label for="edt-password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" id="edt-password" name="password" placeholder="Masukan Password" aria-describedby="edt-password" value="{{old('password')}}"/>
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="edt-role_user" class="form-label">Role Pengguna</label>
                                        <select id="edt-role_user" name="role_user" class="form-control selectpicker">
                                            @foreach($role_users as $val_role)
                                                <option value="{{$val_role->id}}" @selected(old('role_user') == $val_role->id)>{{$val_role->nm_role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label for="edt-status_akun" class="form-label">Status Akun</label>
                                        <select id="edt-status_akun" name="status_akun" class="form-control selectpicker">
                                            <option value="aktif" @selected(old('status_akun') == 'aktif')>Aktif</option>
                                            <option value="tidak_aktif" @selected(old('status_akun') == 'tidak_aktif')>Non Aktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
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
                <form action="{{route('be.masterdata.users.act_hapus_users')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" class="form-control" id="hps-id_user" name="id_user"/>
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

    $('#tbl_user').DataTable({
        "language": indonesia
    });
</script>

<script type="text/javascript">
    function edit_data(id,nm_user,no_tlp,alamat,jns_kelamin,username,password,status_akun,role){
        $('#edt-id_user').val(id);
        $('#edt-nm_user').val(nm_user);
        $('#edt-no_telepon').val(no_tlp);
        $('#edt-alamat').val(alamat);
        $('#edt-jns_kelamin').selectpicker('val', jns_kelamin);
        $('#edt-username').val(username);
        $('#edt-password').val(password);
        $('#edt-status_akun').selectpicker('val', status_akun);
        $('#edt-role_user').selectpicker('val', role);
    }
    function hapus_data(id){
        $('#hps-id_user').val(id);
    }
</script>
@endpush

