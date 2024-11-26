<?php

namespace App\Http\Controllers\Backend\masterdata\pengembang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConbePengembang extends Controller
{
    public function index_semua_pengembang()
    {
        //get Session
        $getSession = Session::get('users_session');
        $id_users   = $getSession['id_user'];
        $nm_role    =  $getSession['nm_role'];

        $query_pengembang = DB::table('tbl_perusahaan_pengembang')
            ->join('tbl_users','tbl_perusahaan_pengembang.id_users','=','tbl_users.id')
            ->join('tbl_users_auth','tbl_users.id','=','tbl_users_auth.id_users')
            ->select('tbl_perusahaan_pengembang.*','tbl_users.nm_user','tbl_users.jns_kelamin','tbl_users_auth.status_akun');
        $query_users = DB::table('tbl_users')
            ->join('tbl_users_auth','tbl_users.id','=','tbl_users_auth.id_users')
            ->select('tbl_users.*','tbl_users_auth.status_akun');

        if ($nm_role == 'superadmin') {
            $pengembang = $query_pengembang
                ->where('tbl_users_auth.status_akun','aktif')
                ->orwhere('tbl_users_auth.status_akun','tidak_aktif')
                ->orderBy('id', 'DESC')
                ->get();
            $users = $query_users
                ->where('tbl_users_auth.status_akun','aktif')
                ->orwhere('tbl_users_auth.status_akun','tidak_aktif')
                ->get();
        }else if ($nm_role == 'developer') {
            $pengembang = $query_pengembang
                ->where('tbl_perusahaan_pengembang.id_users',$id_users)
                ->where('tbl_users_auth.status_akun','aktif')
                ->orwhere('tbl_users_auth.status_akun','tidak_aktif')
                ->orderBy('id', 'DESC')
                ->get();
            $users = $query_users
                ->where('tbl_users.id',$id_users)
                ->where('tbl_users_auth.status_akun','aktif')
                ->orwhere('tbl_users_auth.status_akun','tidak_aktif')
                ->get();
        }
        
        return view('backend.pages.data_master.pengembang.semua_pengembang',compact('pengembang','users'));
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Tambah Data
    //--------------------------------------------------------------------------
    public function act_tambah_pengembang(Request $request)
    {
        $pemilik_perusahaan = $request->pemilik_perusahaan;
        $nm_perusahaan      = $request->nm_perusahaan;
        $no_tlp_perusahaan  = $request->no_tlp_perusahaan;
        $alamat_perusahaan  = $request->alamat_perusahaan;

        //custom notif validasi
        $messages = [
            'required' => ':attribute harus di isi !',
            'not_in'   => ':attribute belum di pilih !'
        ];
        $attribute = array(
            'pemilik_perusahaan'=> 'Pemilik Perusahaan',
            'nm_perusahaan'     => 'Nama Perusahaan',
            'no_tlp_perusahaan' => 'No Telepon Perusahaan',
            'alamat_perusahaan' => 'Alamat Perusahaan'
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'pemilik_perusahaan'=> 'required|not_in:0',
            'nm_perusahaan'     => 'required',
            'no_tlp_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_nm_perusahaan = DB::table('tbl_perusahaan_pengembang')
                ->where('nm_perusahaan', $nm_perusahaan)->count();
            if ($cek_nm_perusahaan > 0) {
                return redirect()->back()->withInput($request->all())->with('failed', 'Nama Perusahaan : sudah ada!');
            }else{
                $add_pengembang = DB::table('tbl_perusahaan_pengembang')
                    ->insert(array(
                        'id_users'          => $pemilik_perusahaan,
                        'nm_perusahaan'     => $nm_perusahaan,
                        'no_tlp_perusahaan' => $no_tlp_perusahaan,
                        'alamat_perusahaan' => $alamat_perusahaan
                    ));
                return redirect()->route('be.masterdata.pengembang.semua_pengembang')->with('success', 'Data Pengembang : Berhasil di tambahkan.');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Edit Data
    //--------------------------------------------------------------------------
    public function act_edit_pengembang(Request $request)
    {
        $id_pengembang     = $request->id_pengembang;
        $nm_perusahaan     = $request->nm_perusahaan;
        $no_tlp_perusahaan = $request->no_tlp_perusahaan;
        $alamat_perusahaan = $request->alamat_perusahaan;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'id_pengembang'     => 'Id Pengembang',
            'nm_perusahaan'     => 'Nama Perusahaan',
            'no_tlp_perusahaan' => 'No Telepon Perusahaan',
            'alamat_perusahaan' => 'Alamat Perusahaan'
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'id_pengembang'     => 'required',
            'nm_perusahaan'     => 'required',
            'no_tlp_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_id_pengembang = DB::table('tbl_perusahaan_pengembang')->where('id', $id_pengembang)->count();
            if ($cek_id_pengembang > 0) {
                $cek_perubahan = DB::table('tbl_perusahaan_pengembang')
                    ->where('id', $id_pengembang)
                    ->where('nm_perusahaan', $nm_perusahaan)
                    ->where('no_tlp_perusahaan', $no_tlp_perusahaan)
                    ->where('alamat_perusahaan', $alamat_perusahaan)->count();
                if ($cek_perubahan > 0) {
                    return redirect()->back()->withInput($request->all())->with('success', 'Pengembang : tidak ada perubahan!');
                }else{
                    $cek_pengembang = DB::table('tbl_perusahaan_pengembang')
                        ->where('id', $id_pengembang)
                        ->where('nm_perusahaan', $nm_perusahaan)->count();
                    if ($cek_pengembang > 0) {
                        $upd_pengembang = DB::table('tbl_perusahaan_pengembang')
                            ->where('id',$id_pengembang)
                            ->update(array(
                                'no_tlp_perusahaan'=> $no_tlp_perusahaan,
                                'alamat_perusahaan'=> $alamat_perusahaan));

                        return redirect()->back()->withInput($request->all())->with('success', 'Pengembang : Berhasil diubah!');
                    }else{
                        $cek_nm_perusahaan = DB::table('tbl_perusahaan_pengembang')
                            ->where('nm_perusahaan', $nm_perusahaan)->count();
                        if ($cek_nm_perusahaan > 0) {
                            return redirect()->back()->withInput($request->all())->with('failed', 'Nama Pengembang : Sudah ada!');
                        }else{
                            $upd_pengembang = DB::table('tbl_perusahaan_pengembang')
                                ->where('id',$id_pengembang)
                                ->update(array(
                                    'nm_perusahaan'    => $nm_perusahaan,
                                    'no_tlp_perusahaan'=> $no_tlp_perusahaan,
                                    'alamat_perusahaan'=> $alamat_perusahaan));

                            return redirect()->back()->withInput($request->all())->with('success', 'Pengembang : Berhasil diubah!');
                        }
                    }
                }
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'Id Pengembang : tidak ditemukan!');
            }
        }
    }

    //--------------------------------------------------------------------------
    //  Function Semua Action Hapus Data
    //--------------------------------------------------------------------------
    public function act_hapus_pengembang(Request $request)
    {
        $id_pengembang = $request->id_pengembang;

        //custom notif validasi
        $messages = [
            'required'  => ':attribute harus di isi !',
        ];
        $attribute = array(
            'id_pengembang'    => 'Id Pengembang',
        );
        // Terima Data request kemudian validasi dulu
        $validasi = $request->validate([
            'id_pengembang'    => 'required',
        ], $messages, $attribute);

        if ($validasi) {
            $cek_id_pengembang = DB::table('tbl_perusahaan_pengembang')->where('id',$id_pengembang)->count();
            if ($cek_id_pengembang > 0) {
                $cek_id_perumahan = DB::table('tbl_perumahan')->where('id_pengembang',$id_pengembang)->count();
                if ($cek_id_perumahan > 0) {
                    return redirect()->back()->withInput($request->all())->with('failed', 'Id Pengembang : dipakai oleh data perumahan! mohon hapus dahulu data perumahan, lalu hapus data pengembang.');
                }else{
                    $del_pengembang = DB::table('tbl_perusahaan_pengembang')->where('id',$id_pengembang)->delete();
                    return redirect()->back()->with('success', 'Data Pengembang : Berhasil di hapus.');
                }
            }else{
                return redirect()->back()->withInput($request->all())->with('failed', 'Id Pengembang : tidak ditemukan!');
            }
        }

    }
}
