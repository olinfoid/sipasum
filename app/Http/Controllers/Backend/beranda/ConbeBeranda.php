<?php

namespace App\Http\Controllers\Backend\beranda;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ConbeBeranda extends Controller
{
    public function index()
    {
        $getSession = Session::get('users_session');
        $id_users = $getSession['id_user'];
        $nm_role    =  $getSession['nm_role'];

        if ($nm_role == 'superadmin') {
            $jml_pengembang = DB::table('tbl_perusahaan_pengembang')->count();
            $jml_perumahan = DB::table('tbl_perumahan')->count();
            $jml_permohonan_psu = DB::table('tbl_psu_permohonan')->count();
        }else if ($nm_role == 'developer') {
            $jml_pengembang = DB::table('tbl_perusahaan_pengembang')->where('id_users',$id_users)->count();

            $jml_perumahan = DB::table('tbl_perumahan')
                ->join('tbl_perusahaan_pengembang','tbl_perumahan.id_pengembang','=','tbl_perusahaan_pengembang.id')
                ->select('tbl_perumahan.*')
                ->where('tbl_perusahaan_pengembang.id_users',$id_users)
                ->count();
            $jml_permohonan_psu = DB::table('tbl_psu_permohonan')
                ->join('tbl_perumahan','tbl_psu_permohonan.id_perumahan','=','tbl_perumahan.id')
                ->join('tbl_perusahaan_pengembang','tbl_perumahan.id_pengembang','=','tbl_perusahaan_pengembang.id')
                ->select('tbl_psu_permohonan.*')
                ->where('tbl_perusahaan_pengembang.id_users',$id_users)
                ->count();
        }

        return view('backend.pages.beranda.index',compact(
            'jml_pengembang','jml_perumahan','jml_permohonan_psu'
        ));
    }
}
