<?php

namespace App\Http\Controllers\Backend\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConbeProfile extends Controller
{
    public function index_akun()
    {
        $getSession = Session::get('users_session');
        $id_users = $getSession['id_user'];

        $users = DB::table('tbl_users')
            ->join('tbl_users_auth','tbl_users.id','=','tbl_users_auth.id_users')
            ->join('tbl_users_role_relasi','tbl_users.id','=','tbl_users_role_relasi.id_users')
            ->join('tbl_users_role','tbl_users_role_relasi.id_role','=','tbl_users_role.id')
            ->select('tbl_users.*',
                'tbl_users_auth.username','tbl_users_auth.password','tbl_users_auth.status_akun',
                'tbl_users_role_relasi.id_role','tbl_users_role.nm_role')
            ->where('tbl_users.id',$id_users)
            ->where('tbl_users_auth.status_akun','aktif')
            ->orWhere('tbl_users_auth.status_akun', '=', 'tidak_aktif')
            ->get();

        return view('backend.pages.profile.index',compact('users'));
    }

    public function act_edit_akun(Request $request)
    {
        $id_user     = $request->id_user;
        $nm_user     = $request->nm_user;
        $no_telepon  = $request->no_telepon;
        $jns_kelamin = $request->jns_kelamin;
        $alamat      = $request->alamat;
        $username    = $request->username;
        $password    = $request->password;

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
                    ->where('tbl_users_auth.password', $password)->count();
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
                                'password'    => $password
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
                                        'password'    => $password
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
}
