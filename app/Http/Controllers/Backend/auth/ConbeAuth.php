<?php

namespace App\Http\Controllers\Backend\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;

class ConbeAuth extends Controller
{
    public function index_login()
    {
        $cek_session_login = $this->cek_session();
        if ($cek_session_login == "true") {

            //Tampilkan Notif dengan Toastr
            $msg = "Anda sudah login!";
            Toastr::success($msg, 'Maaf', ["positionClass" => "toast-top-right"]);

            return redirect()->route('be.beranda');
        } else {
            return view('backend.pages.auth.login');
        }
    }

    public function act_login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !!!',
        ];
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], $messages);

        if ($validasi) {
            $cek_akun = DB::table('tbl_users_auth')
                ->where('username',$username)
                ->where('password',$password)
                ->where('status_akun','aktif')->count();
            if ($cek_akun > 0) {
                
                $get_usr = DB::table('tbl_users')
                    ->join('tbl_users_auth','tbl_users.id','=','tbl_users_auth.id_users')
                    ->join('tbl_users_role_relasi','tbl_users.id','=','tbl_users_role_relasi.id_users')
                    ->join('tbl_users_role','tbl_users_role_relasi.id_role','=','tbl_users_role.id')
                    ->select('tbl_users.*','tbl_users_auth.username','tbl_users_auth.status_akun','tbl_users_role.nm_role')
                    ->where('tbl_users_auth.username',$username)
                    ->where('tbl_users_auth.password',$password)
                    ->where('tbl_users_auth.status_akun','aktif')
                    ->first();

                //Buat Session
                $users_session = [
                    'id_user'     => $get_usr->id,
                    'nm_user'     => $get_usr->nm_user,
                    'jns_kelamin' => $get_usr->jns_kelamin,
                    'username'    => $get_usr->username,
                    'nm_role'     => $get_usr->nm_role,
                ];
                Session::put('users_session', $users_session);
                Session::put('login', TRUE);

                //Tampilkan Notif dengan Toastr
                $msg = "Autentikasi berhasil :)";
                Toastr::success($msg, 'Berhasil', ["positionClass" => "toast-top-right"]);

                return redirect()->route('be.beranda');
            }else{

                //Tampilkan Notif dengan Toastr
                $msg = "Username atau Passwod Salah!";
                Toastr::error($msg, 'Maaf', ["positionClass" => "toast-top-center"]);

                return redirect()->back();
            }
        }
    }

    public function cek_session()
    {
        if (Session::has('login')) {
            $get_login = "true";
        } else {
            $get_login = "false";
        }
        return $get_login;
    }

    public function act_logout()
    {
        Session::flush();

        //Tampilkan Notif dengan Toastr
        $msg = "Kamu Keluar :(";
        Toastr::error($msg, 'Berhasil', ["positionClass" => "toast-top-center"]);

        return redirect()->route('auth.login');
    }
}
