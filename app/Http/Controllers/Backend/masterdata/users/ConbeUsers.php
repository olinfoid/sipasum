<?php

namespace App\Http\Controllers\Backend\masterdata\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConbeUsers extends Controller
{
    //--------------------------------------------------------------------------
    //  Function Semua View Index
    //--------------------------------------------------------------------------
    public function index_role_users()
    {
        $role_users = DB::table('tbl_users_role')
            ->orderBy('id', 'DESC')
            ->get();

        return view('backend.pages.data_master.users.role_users',compact('role_users'));
    }

    public function index_semua_users()
    {
        $users = DB::table('tbl_users')
            ->join('tbl_users_auth','tbl_users.id','=','tbl_users_auth.id_users')
            ->join('tbl_users_role_relasi','tbl_users.id','=','tbl_users_role_relasi.id_users')
            ->join('tbl_users_role','tbl_users_role_relasi.id_role','=','tbl_users_role.id')
            ->select('tbl_users.*',
                'tbl_users_auth.username','tbl_users_auth.password','tbl_users_auth.status_akun',
                'tbl_users_role_relasi.id_role','tbl_users_role.nm_role')
            ->where('tbl_users_auth.status_akun','aktif')
            ->orWhere('tbl_users_auth.status_akun', '=', 'tidak_aktif')
            ->orderBy('tbl_users.id', 'DESC')
            ->get();
        $role_users = DB::table('tbl_users_role')->get();
        return view('backend.pages.data_master.users.semua_users',compact('users','role_users'));
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Tambah Data
    //--------------------------------------------------------------------------
    public function act_tambah_role_users(Request $request)
    {
        $nm_role = $request->nm_role;
        $keterangan = $request->keterangan;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'nm_role'    => 'Nama Role',
            'keterangan' => 'Keterangan',
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'nm_role'    => 'required',
            'keterangan' => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_nm_role = DB::table('tbl_users_role')
                ->where('nm_role', $nm_role)->count();
            if ($cek_nm_role > 0) {
                return redirect()->back()->withInput($request->all())->with('failed', 'Nama Role : sudah ada!');
            }else{
                $add_role = DB::table('tbl_users_role')
                    ->insert(array('nm_role'=>$nm_role,'keterangan'=>$keterangan));
                return redirect()->back()->with('success', 'Data Role : Berhasil di tambahkan.');
            }
        }
    }

    public function act_tambah_users(Request $request)
    {
        $nm_user     = $request->nm_user;
        $no_telepon  = $request->no_telepon;
        $jns_kelamin = $request->jns_kelamin;
        $alamat      = $request->alamat;
        $username    = $request->username;
        $password    = $request->password;
        $role_user   = $request->role_user;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'nm_user'     => 'Nama Pengguna',
            'no_telepon'  => 'No Telepon',
            'jns_kelamin' => 'Jenis Kelamin',
            'alamat'      => 'Alamat',
            'username'    => 'Username',
            'password'    => 'Password',
            'role_user'   => 'Role Pengguna'
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'nm_user'     => 'required',
            'no_telepon'  => 'required',
            'jns_kelamin' => 'required',
            'alamat'      => 'required',
            'username'    => 'required',
            'password'    => 'required',
            'role_user'   => 'required'
        ], $messages, $attribute);

        if ($validasi) {
            $cek_no_tlp = DB::table('tbl_users')
                ->where('no_tlp', $no_telepon)->count();
            if ($cek_no_tlp > 0) {
                return redirect()->back()->withInput($request->all())->with('failed', 'No Telepon : sudah ada!');
            }else{
                $cek_username = DB::table('tbl_users_auth')->where('username',$username)->count();
                if ($cek_username) {
                    return redirect()->back()->withInput($request->all())->with('failed', 'Username : sudah ada!');
                }else{
                    $id_user = DB::table('tbl_users')
                        ->insertGetId(array(
                            'nm_user'    => $nm_user,
                            'no_tlp'     => $no_telepon,
                            'alamat'     => $alamat,
                            'jns_kelamin'=> $jns_kelamin
                        ));
                    $add_auth = DB::table('tbl_users_auth')
                        ->insert(array(
                            'id_users'    => $id_user,
                            'username'    => $username,
                            'password'    => $password,
                            'status_akun' => 'aktif'
                        ));
                    $add_role_user = DB::table('tbl_users_role_relasi')
                        ->insert(array(
                            'id_users' => $id_user,
                            'id_role'  => $role_user
                        ));
                    return redirect()->route('be.masterdata.users.semua_users')->with('success', 'Data Pengguna : Berhasil di tambahkan.');
                }
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Edit Data
    //--------------------------------------------------------------------------
    public function act_edit_role_users(Request $request)
    {
        $id_role = $request->id_role;
        $nm_role = $request->nm_role;
        $keterangan = $request->keterangan;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'id_role'    => 'Id Role',
            'nm_role'    => 'Nama Role',
            'keterangan' => 'Keterangan',
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'id_role'    => 'required',
            'nm_role'    => 'required',
            'keterangan' => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_id_role = DB::table('tbl_users_role')->where('id', $id_role)->count();
            if ($cek_id_role > 0) {
                $cek_perubahan = DB::table('tbl_users_role')
                    ->where('nm_role', $nm_role)
                    ->where('keterangan', $keterangan)->count();
                if ($cek_perubahan > 0) {
                    return redirect()->back()->withInput($request->all())->with('success', 'Role : tidak ada perubahan!');
                }else{
                    $cek_role = DB::table('tbl_users_role')
                        ->where('id', $id_role)
                        ->where('nm_role', $nm_role)->count();
                    if ($cek_role > 0) {
                        $upd_role = DB::table('tbl_users_role')
                            ->where('id',$id_role)
                            ->update(array('keterangan'=>$keterangan));
                        return redirect()->back()->with('success', 'Data Role : Berhasil di ubah.');
                    }else{
                        $cek_nm_role = DB::table('tbl_users_role')
                            ->where('nm_role', $nm_role)->count();
                        if ($cek_nm_role > 0) {
                            return redirect()->back()->withInput($request->all())->with('failed', 'Nama Role : sudah ada!');
                        }else{
                            $upd_role = DB::table('tbl_users_role')
                                ->where('id',$id_role)
                                ->update(array('nm_role'=>$nm_role,'keterangan'=>$keterangan));
                            return redirect()->back()->with('success', 'Data Role : Berhasil di ubah.');
                        }
                    } 
                }
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'Id Role : tidak ditemukan!');
            }
        }
    }

    public function act_edit_users(Request $request)
    {
        $id_user     = $request->id_user;
        $nm_user     = $request->nm_user;
        $no_telepon  = $request->no_telepon;
        $jns_kelamin = $request->jns_kelamin;
        $alamat      = $request->alamat;
        $username    = $request->username;
        $password    = $request->password;
        $status_akun = $request->status_akun;
        $role_user   = $request->role_user;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'id_user'     => 'Id User',
            'nm_user'     => 'Nama Lengkap',
            'no_telepon'  => 'No Telepon',
            'jns_kelamin' => 'Jenis Kelamin',
            'alamat'      => 'Alamat',
            'username'    => 'Username',
            'password'    => 'Password',
            'status_akun' => 'Status Akun',
            'role_user'   => 'Role Pengguna',
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'id_user'     => 'required',
            'nm_user'     => 'required',
            'no_telepon'  => 'required',
            'jns_kelamin' => 'required',
            'alamat'      => 'required',
            'username'    => 'required',
            'password'    => 'required',
            'status_akun' => 'required',
            'role_user'   => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_id_user = DB::table('tbl_users')->where('id', $id_user)->count();
            if ($cek_id_user > 0) {
                $cek_perubahan = DB::table('tbl_users')
                    ->join('tbl_users_auth','tbl_users.id','=','tbl_users_auth.id_users')
                    ->join('tbl_users_role_relasi','tbl_users.id','=','tbl_users_role_relasi.id_users')
                    ->select('tbl_users.*','tbl_users_auth.username','tbl_users_auth.password',
                        'tbl_users_role_relasi.id_role')
                    ->where('tbl_users.nm_user', $nm_user)
                    ->where('tbl_users.no_tlp', $no_telepon)
                    ->where('tbl_users.jns_kelamin', $jns_kelamin)
                    ->where('tbl_users.alamat', $alamat)
                    ->where('tbl_users_auth.username', $username)
                    ->where('tbl_users_auth.password', $password)
                    ->where('tbl_users_auth.status_akun', $status_akun)
                    ->where('tbl_users_role_relasi.id_role', $role_user)->count();
                if ($cek_perubahan > 0) {
                    return redirect()->back()->withInput($request->all())->with('success', 'Pengguna : tidak ada perubahan!');
                }else{
                    $cek_user = DB::table('tbl_users')
                        ->join('tbl_users_auth','tbl_users.id','=','tbl_users_auth.id_users')
                        ->select('tbl_users.*','tbl_users_auth.username','tbl_users_auth.password')
                        ->where('tbl_users.id', $id_user)
                        ->where('tbl_users.no_tlp', $no_telepon)
                        ->where('tbl_users_auth.username', $username)->count();
                    if ($cek_user > 0) {
                        $upd_user = DB::table('tbl_users')
                            ->where('id',$id_user)
                            ->update(array(
                                'nm_user'    => $nm_user,
                                'alamat'     => $alamat,
                                'jns_kelamin'=> $jns_kelamin
                            ));
                        $upd_auth = DB::table('tbl_users_auth')
                            ->where('id_users',$id_user)
                            ->update(array(
                                'password'    => $password,
                                'status_akun' => $status_akun
                            ));
                        $upd_role = DB::table('tbl_users_role_relasi')
                            ->where('id_users',$id_user)
                            ->update(array(
                                'id_role'    => $role_user
                            ));
                        return redirect()->back()->with('success', 'Data Pengguna : Berhasil di ubah.');
                    }else{
                        $cek_no_tlp = DB::table('tbl_users')
                            ->where('id', $id_user)
                            ->where('no_tlp', $no_telepon)->count();
                        $cek_username = DB::table('tbl_users_auth')
                            ->where('id_users', $id_user)
                            ->where('username', $username)->count();
                        if (($cek_username == 0)&&($cek_no_tlp > 0)) {
                            $cek_username_tersedia = DB::table('tbl_users_auth')
                                ->where('username', $username)->count();
                            if ($cek_username_tersedia > 0) {
                                return redirect()->back()->withInput($request->all())->with('failed', 'Username : sudah ada!');
                            }else{
                                $upd_user = DB::table('tbl_users')
                                    ->where('id',$id_user)
                                    ->update(array(
                                        'nm_user'    => $nm_user,
                                        'alamat'     => $alamat,
                                        'jns_kelamin'=> $jns_kelamin
                                    ));
                                $upd_auth = DB::table('tbl_users_auth')
                                    ->where('id_users',$id_user)
                                    ->update(array(
                                        'username'    => $username,
                                        'password'    => $password,
                                        'status_akun' => $status_akun
                                    ));
                                $upd_role = DB::table('tbl_users_role_relasi')
                                    ->where('id_users',$id_user)
                                    ->update(array(
                                        'id_role'    => $role_user
                                    ));
                                return redirect()->back()->with('success', 'Data Pengguna : Berhasil di ubah.');
                            }
                        }else if(($cek_no_tlp == 0)&&($cek_username > 0)){
                            $cek_notlp_tersedia = DB::table('tbl_users')
                                ->where('no_tlp', $no_telepon)->count();
                            if ($cek_notlp_tersedia > 0) {
                                return redirect()->back()->withInput($request->all())->with('failed', 'No Telepon : sudah ada!');
                            }else{
                                $upd_user = DB::table('tbl_users')
                                    ->where('id',$id_user)
                                    ->update(array(
                                        'nm_user'    => $nm_user,
                                        'no_tlp'     => $no_telepon,
                                        'alamat'     => $alamat,
                                        'jns_kelamin'=> $jns_kelamin
                                    ));
                                $upd_auth = DB::table('tbl_users_auth')
                                    ->where('id_users',$id_user)
                                    ->update(array(
                                        'password'    => $password,
                                        'status_akun' => $status_akun
                                    ));
                                $upd_role = DB::table('tbl_users_role_relasi')
                                    ->where('id_users',$id_user)
                                    ->update(array(
                                        'id_role'    => $role_user
                                    ));
                                return redirect()->back()->with('success', 'Data Pengguna : Berhasil diubah.');
                            }
                        }
                    } 
                }
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'Id Pengguna : tidak ditemukan!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Hapus Data
    //--------------------------------------------------------------------------
    public function act_hapus_role_users(Request $request)
    {
        $id_role = $request->id_role;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'id_role'    => 'Id Role',
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'id_role'    => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_id_role = DB::table('tbl_users_role')->where('id',$id_role)->count();
            if ($cek_id_role > 0) {
                $del_role = DB::table('tbl_users_role')->where('id',$id_role)->delete();
                return redirect()->back()->with('success', 'Data Role : Berhasil di hapus.');
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'Id Role : tidak ditemukan!');
            }
        }
    }

    public function act_hapus_users(Request $request)
    {
        $id_user = $request->id_user;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'id_user'    => 'Id Role',
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'id_user'    => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_id_user = DB::table('tbl_users')->where('id',$id_user)->count();
            if ($cek_id_user > 0) {
                $del_user = DB::table('tbl_users_auth')->where('id_users',$id_user)->update(array('status_akun'=>'dihapus'));
                return redirect()->back()->with('success', 'Data User : Berhasil di hapus.');
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'Id User : tidak ditemukan!');
            }
        }
    }
}
